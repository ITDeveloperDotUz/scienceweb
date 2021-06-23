<?php

namespace App\Models;

use App\Providers\GoogleScholarProfileProvider;
use App\Providers\PublonsProvider;
use App\Providers\ScopusProvider;
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
        return $this->hasOne(GoogleScholarProfile::class);
    }

    public function publonsProfile()
    {
        return $this->hasOne(PublonsProfile::class);
    }

    public function scopusProfile()
    {
        return $this->hasOne(ScopusProfile::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function tariff()
    {
        return $this->belongsToMany(Tariff::class,'tariffs_users', 'user_id', 'tariff_id');
    }

    public function refreshGSProfile()
    {
        $gs_data = GoogleScholarProfileProvider::getProfileData($this->gs_profile);

        if ($gs_data and $gs_data['status']){
            $this->scholarProfile()->updateOrCreate(['user_id' => $this->id], [
                'avatar' => $gs_data['avatar'] ?? 'https://scholar.google.com/citations/images/avatar_scholar_128.png',
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
            return true;
        } else {
            if ($this->scholarProfile){
                $this->scholarProfile->delete();
            }
            $this->update(['gs_profile' => '']);
            return false;
        }
    }

    public function refreshPublonsProfile($link)
    {
        $data = PublonsProvider::getProfileData($link);;
        if ($data and $data['status']){
            $this->publonsProfile()->updateOrCreate(['user_id' => $this->id], [
                'citations_per_year' => isset($data['metrics']['citationsPerYear']) ? json_encode($data['metrics']['citationsPerYear']) : null,
                'per_month_graph' => isset($data['pmg']) ? json_encode($data['pmg']) : null,
                'publication_stats' => $data['publication_stats'] ? json_encode($data['publication_stats']) : null,
                'per_year_graph' => isset($data['pyg']) ? json_encode($data['pyg']) : null,
                'institutions' => count($data['summary']['institutions']) ? json_encode($data['summary']['institutions']) : null,
                'awards' => count($data['summary']['awards']) ? json_encode($data['summary']['awards']) : null,
                'researchFields' => count($data['summary']['researchFields']) ? json_encode($data['summary']['researchFields']) : null,
                'publons_user_id' => $data['user_id'],
                'publons_user_name' => $data['user_name'],
                'avatar' => $data['avatar'],
                'citations' => $data['metrics']['timesCited'] ?? null,
                'publications_count' => $data['publications_count'],
                'h_index' => $data['metrics']['hIndex'] ?? null,
                'average_per_year' => $data['metrics']['averagePerYear'] ?? null,
                'average_per_item' => $data['metrics']['averagePerItem'] ?? null
            ]);
            return true;
        } else {
            if ($this->publonsProfile){
                $this->publonsProfile->delete();
            }
            return false;
        }
    }

    public function refreshScopusProfile($link)
    {
        $data = ScopusProvider::getProfileData($link);;

        if ($data and $data['status']){
            $this->scopusProfile()->updateOrCreate(['user_id' => $this->id], [
                'full_name' => $data['summary']['preferredName']['full'] ?? null,
                'first_name' => $data['summary']['preferredName']['first'] ?? null,
                'last_name' => $data['summary']['preferredName']['last'] ?? null,
                'orcid' => $data['summary']['orcId'] ?? null,
                'institution' => !empty($data['summary']['latestAffiliatedInstitution']) ? $data['summary']['latestAffiliatedInstitution']['name'] : null,
                'h_index' => $data['summary']['hindex'] ?? null,
                'email' => $data['summary']['emailAddress'] ?? null,
                'documents_count' => $data['summary']['documentCount'] ?? null,
                'co_authors' => $data['summary']['coAuthorsCount'] ?? null,
                'cited_by_count' => $data['summary']['citedByCount'] ?? null,
                'citations_count' => $data['summary']['citationsCount'] ?? null,
                'author_id' => $data['summary']['authorId'] ?? null,
                'subject_areas' => isset($data['summary']['publishedSubjectAreas']) ? json_encode($data['summary']['publishedSubjectAreas']) : null,
                'chart' => $data['chart'] ? json_encode($data['chart']) : null,
                'publications' => $data['pubs'] ? json_encode($data['pubs']) : null
            ]);
            return true;
        } else {
            if ($this->scopusProfile){
                $this->scopusProfile->delete();
            }
            return false;
        }
    }
}
