<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\ProfilesGoogleScholar;
use App\Models\User;
use App\Providers\GoogleScholarProfileProvider;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function profile(Request $request, $orcid = null)
    {
        if ($orcid){
            $user = User::where('orcid', $orcid)->first();
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
        $user = auth()->user();
        $data = $request->post();
        $user->profile->update(array_diff_key($data, ['_token' => '', 'method' => '', 'gs_profile' => '']));

        if (isset($data['links'])){
            $user->update($data);
            if (isset($data['gs_profile'])){
                $user->refreshGSProfile($data['gs_profile']);
            } else {
                if ($user->scholarProfile){
                    $user->scholarProfile->delete();
                }
            }
        }

        return redirect()->route('profile.home');
    }
}

