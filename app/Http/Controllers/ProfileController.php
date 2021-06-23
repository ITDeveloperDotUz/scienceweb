<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\GoogleScholarProfile;
use App\Models\Profile;
use App\Models\PublonsProfile;
use App\Models\ScopusProfile;
use App\Models\User;
use App\Providers\GoogleScholarProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function Symfony\Component\String\s;

class ProfileController extends Controller
{
    public function getList($system = 'scienceweb')
    {
        switch ($system){
            case 'google_scholar':
                $profiles = GoogleScholarProfile::all();
                break;
            case 'publons':
                $profiles = PublonsProfile::orderBy('citations', 'desc')
                    ->orderBy('h_index', 'desc')
                    ->orderBy('publications_count', 'desc')
                    ->limit(100)->get();
                break;
            case 'scopus':
                $profiles = ScopusProfile::all();
                break;
            default:
                $profiles = Profile::filled()->with('user')->limit(100)->get();
        }

        return view('authors.'.$system, compact('profiles'));
    }

    public function publicProfile($orcid)
    {
        $user = User::where('orcid', $orcid)->first();
        return view('profile.public', ['user' => $user]);
    }

    public function profile()
    {
        if (!auth()->check()){
            return redirect(route('login'));
        } else {
            $user = auth()->user();
        }
        if ($user->guard_name == 'publisher'){
            return $this->publisherProfile($user);
        }
        return view('profile.user', ['user' => $user]);
    }

    public function publisherProfile($user)
    {
        $events = $user->events()->with('details')->paginate(10);
        return view('profile.publisher', compact('user', 'events'));
    }

    public function edit(Request $request)
    {
        $countries = Country::all();
        return view('profile.edit', ['countries' => $countries]);
    }

    public function update(Request $request)
    {
        $messages = [];
        $user = auth()->user();
        $data = $request->post();
        if (isset($data['links'])){
            $google_scholar = $data['social_links']['google_scholar'] ? Str::of($data['social_links']['google_scholar'])->match('/user=([A-Za-z0-9_-]+)/') : null;
            $orcid = $data['social_links']['orcid'] ? Str::of($data['social_links']['orcid'])->match('/\w{4}-\w{4}-\w{4}-\w{4}/'): null;
            $user->update([
                'gs_profile' => $google_scholar,
                'orcid' => $orcid
            ]);
            $data['orcid'] = $orcid;
            if (!isset($data['social_links']['google_scholar'])){
                if ($user->scholarProfile){
                    $user->scholarProfile->delete();
                }
            }

            if (!isset($data['social_links']['publons'])){
                if ($user->publonsProfile){
                    $user->publonsProfile->delete();
                }
            }

            if (!isset($data['social_links']['scopus'])){
                if ($user->scopusProfile){
                    $user->scopusProfile->delete();
                }
            }
        }
        $user->profile->update($data);

        return redirect()->route('profile.home')->with(['messages' => $messages]);
    }

    public function refreshProfiles($system, $user_id)
    {
        $user = User::find($user_id);
        $messages = [];
        $link = json_decode($user->profile->social_links, true)[$system];
        if ($link === null){
            return redirect(route('profile.home'))->with([
                'messages' => [[
                    'status' => 'warning',
                    'message' => 'Отсутсувет ссылка на указанный профиль. Добавьте её на ' .
                        '<a href="'.route('profile.edit').'">странице настроек</a>'
                ]]
            ]);
        } else {
            if ($system == 'google_scholar'){
                if ($user->refreshGSProfile()){
                    $messages[] = ['status' => 'success', 'message' => 'Ваш аккаунт в Google Scholar успешно связвн'];
                } else {
                    $messages[] = ['status' => 'danger', 'message' => 'Не удалось найти профиль в системе Google Scholar. Проверьте ссылку на профиль и попробуйти обновить настройки.'];
                }
            }

            if ($system == 'publons'){
                if ($user->refreshPublonsProfile($link)){
                    $messages[] = ['status' => 'success', 'message' => 'Ваш аккаунт в системе Publons (Web Of Science) успешно связвн'];
                } else {
                    $messages[] = ['status' => 'danger', 'message' => 'Не удалось найти профиль в системе Publons (Web Of Science). Проверьте ссылку на профиль и попробуйти обновить настройки.'];
                }
            }

            if ($system == 'scopus'){
                if ($user->refreshScopusProfile($link)){
                    $messages[] = ['status' => 'success', 'message' => 'Ваш аккаунт в системе Publons (Web Of Science) успешно связвн'];
                } else {
                    $messages[] = ['status' => 'danger', 'message' => 'Не удалось найти профиль в системе Publons (Web Of Science). Проверьте ссылку на профиль и попробуйти обновить настройки.'];
                }
            }
        }
        return redirect(route('profile.home'))->with(['messages' => $messages]);
    }
}

