<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\OrcidToken;
use App\Models\Publisher;
use App\Providers\ORCIDProvider;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    protected $org_types = [
        1 => 'Общество с ограниченной или дополнительной ответственностью (ООО или ОДО)',
        2 => 'Индивидуальный предприниматель',
        3 => 'Частное предприятие (ЧП)',
        4 => 'Семейное предприятие',
        5 => 'Акционерное общество (АО)',
        6 => 'Другая форма юридического лица',
    ];
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function userValidator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\'\-]+$/u'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\'\-]+$/u'],
            'middle_name' => ['max:255', 'regex:/^[a-zA-Z\s\'\-]+$/u', 'nullable'],
            'phone' => ['string', 'max:15', 'regex:/^\+?[0-9]+$/u'],
            'country_code' => ['required'],
            'state' => ['string', 'max:255', 'regex:/^[a-zA-Z0-9\-\s]+$/u'],
//            'address_1' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\-\s]+$/u'],
//            'address_2' => ['max:255', 'regex:/^[a-zA-Z0-9\-]+$/u', 'nullable'],
            'accept' => ['accepted'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
        ],[
            '*.required' => 'Это поле обязательно для заполнения.',
            'role.required' => 'Выберите одно из ролей.',
            '*.max' => 'Максимальное количество символов 255.',
            'first_name.regex' => 'Введите имя только латинскими буквами.',
            'last_name.regex' => 'Введите фамилию только латинскими буквами.',
            'middle_name.regex' => 'Введите отчество только латинскими буквами.',
            'phone.regex' => 'Введите номер телефона в формате +123456789 (без пробелов).',
            'state.regex' => 'Введите регион только латинскими буквами.',
//            'address_1.regex' => 'Введите адрес 1 только латинскими буквами.',
//            'address_2.regex' => 'Введите адрес 2 только латинскими буквами.',
            'accept.accepted' => 'Вы должны согласиться с пользовательским соглашением системы.',
            'email.email' => 'Введите email в формате example@mail.com.',
            'email.unique' => 'Email не должен бқть зарегистрирован в системе ранее.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
        ]);
    }

    protected function publisherValidator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'tin' => ['required', 'digits:9'],
            'country_code' => ['required'],
            'state' => ['required'],
            'postal_code' => ['required', 'digits_between:4,10'],
            'address' => ['required', 'string'],
            'email' => ['required', 'unique:App\Models\Publisher,email'],
            'phone' => ['required', 'digits_between:10,12'],
            'affiliate_person' => ['required', 'string'],
            'bank_account' => ['required', 'string', 'max:30', 'min:10',  'regex:/^[0-9\s-]+$/'],
            'bank_name' => ['required', 'string'],
            'bank_code' => ['required', 'string', 'regex:/^[0-9\s-]+$/'],
            'website' => ['required', 'url'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'accept' => ['accepted']
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param
     * @return
     */
    protected function register(Request $request)
    {
        $data = ($request->input());
        if ($data['role'] == 'author') {
            return $this->registerUser($data);
        }
        if ($data['role'] == 'publisher'){
            return $this->registerPublisher($data);
        }
        return back()->with(['messages' => [['status' => 'danger', 'message' => 'Something went wrong please retry']]]);
    }

    // Register
    public function showRegistrationForm(Request $request){
        $pageConfigs = ['bodyCustomClass' => 'register-bg', 'isCustomizer' => false];
        $countries = Country::all();
        if ($request->session()->has('details')) {
            $data = $request->session()->get('details');
            session()->flashInput([
                'first_name' => $data['person']['name']['given-names']['value'],
                'last_name' => $data['person']['name']['family-name']['value'],
                'country_code' => $data['person']['addresses']['address'][0]['country']['value'],
                'email' => $data['person']['emails']['email'][0]['email'],
                'orcid' => session()->get('orcidToken')['orcid']
            ]);
            OrcidToken::create($request->session()->get('orcidToken'));
        }
        return view('auth.register', [
            'pageConfigs' => $pageConfigs, 'countries' => $countries, 'org_types' => $this->org_types
        ]);
    }

    public function registerUser($data)
    {
        $validator = $this->userValidator($data);
        if ($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($data);
        }

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country_code' => $data['country_code'],
            'state' => $data['state'],
            'orcid' =>  $data['orcid'] ? Str::of($data['orcid'])->match('/\w{4}-\w{4}-\w{4}-\w{4}/'): null,
            'gs_profile' => $data['google_scholar'] ? Str::of($data['google_scholar'])->match('/user=([A-Za-z0-9_-]+)/') : null,
//            'address_1' => $data['address_1'],
//            'address_2' => $data['address_2'],
            'password' => Hash::make($data['password']),
        ]);

        $user->profile()->create([
            'orcid' => $user->orcid,
            'social_links' => json_encode([
                'orcid' => 'https://orcid.org/'.$user->orcid,
                'google_scholar' => 'https://scholar.google.com/citations?user='.$user->gs_profile,
            ])
        ]);
        if ($data['google_scholar']){
            $user->refreshGSProfile($user->gs_profile);
        }
        $user->assignRole([$data['role'], 'user-basic-tariff']);
        if ($user){
            $user->sendEmailVerificationNotification();
            return redirect(route('login'))->with(['messages' => [['status' => 'success', 'message' => 'Registration was successful please sign in']]]);
        } else {
            return back()->with(['messages' => [['status' => 'danger', 'message' => 'Something went wrong please retry']]]);
        }
    }

    public function registerPublisher($data)
    {

        $validator = $this->publisherValidator($data);
        if ($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($data);
        }
        $data['preferred_locale'] = app()->getLocale();
        $data['password'] = Hash::make($data['password']);
        $publisher = Publisher::create($data);
        $publisher->assignRole($data['role']);
        if ($publisher){
            $publisher->sendEmailVerificationNotification();
            return redirect(route('login'))->with(['messages' => [['status' => 'success', 'message' => 'Registration was successful please sign in']]]);
        } else {
            return back()->with(['messages' => [['status' => 'danger', 'message' => 'Something went wrong please retry']]]);
        }
    }

    public function orcidRidrect()
    {
        return ORCIDProvider::getAccessToken();
    }

    public function orcidCallback(Request $request)
    {
        $token = ORCIDProvider::getUserToken($request->code);
        $details = ORCIDProvider::getPersonalDetails($token);
        return redirect(route('register'))->with(['orcidToken' => $token, 'details' => $details]);
    }

}
