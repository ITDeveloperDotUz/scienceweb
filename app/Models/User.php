<?php

namespace App\Models;

use App\Providers\GoogleScholarProfileProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'role',
        'country_code',
        'state',
        'locale',
        'email',
        'gs_profile',
        'orcid',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $guard_name = 'user';
    protected $guard = 'user';


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'iso2', 'country_code');
    }

    public function scholarProfile()
    {
        return $this->hasOne(ProfilesGoogleScholar::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function tariff()
    {
        return $this->belongsToMany(Tariff::class,'tariffs_users', 'user_id', 'tariff_id');
    }

    public function refreshGSProfile($link)
    {
        $gs_user_id = $link;
        $gs_data = GoogleScholarProfileProvider::getProfileData($gs_user_id);
        if ($gs_data != []){
            $this->scholarProfile()->updateOrCreate(['user_id' => $this->id], [
                'citations' => $gs_data['citations'] ? $gs_data['citations'][0] : 0,
                'citations_five_year' => $gs_data['citations'] ? $gs_data['citations'][1] : 0,
                'h_index' => $gs_data['h_index'] ? $gs_data['h_index'][0] : 0,
                'h_index_five_year' => $gs_data['h_index'] ? $gs_data['h_index'][1] : 0,
                'i10_index' => $gs_data['i10_index'] ? $gs_data['i10_index'][0] : 0,
                'i10_index_five_year' => $gs_data['i10_index'] ? $gs_data['i10_index'][1] : 0,
                'by_year' => json_encode($gs_data['by_year']),
                'gs_user_id' => $gs_data['user_id'],
                'name' => $gs_data['name'],
                'organization' => $gs_data['organization'],
                'domain' => $gs_data['domain'],
                'interests' => json_encode($gs_data['aoi'])
            ]);
        } else {
            if ($this->scholarProfile){
                $this->scholarProfile->delete();
            }
            $this->update(['gs_profile' => '']);
        }
        return $this;
    }
}
