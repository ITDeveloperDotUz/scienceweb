@extends('layouts.app')
@php($user = auth()->user())

@section('content')
    <div class="auto-container">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @isset($user->profile->avatar)
                                    <img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->first_name . ' ' . $user->last_name }} profile image" class="rounded-circle" width="150" height="150">
                                @else
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="default profile image" class="rounded-circle" width="150" height="150">
                                @endisset
                                <div class="mt-3">
                                    <form action="{{ url('user/upload-avatar') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <input type="file" name="avatar" required class="form-control my-3">
                                        <button class="btn btn-dark">Save</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    @include('profile.profile_menu')
                </div>
                <div class="col-md-8">

                    <div class="card mb-3">
                        <form action="{{ url('user/update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Account </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="first_name">First Name</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="last_name">Last Name</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="middle_name">Middle Name</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ $user->middle_name }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="email">Email</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="phone">Phone</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="country_code">Country</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select type="text" class="form-control" name="country_code" id="country_code">
                                            @foreach($countries as $country)
                                                <option value="{{ $country->iso2 }}" {{ $user->country_code == $country->iso2 ? 'selected' : '' }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="state">State</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="state" id="state" value="{{ $user->state }}">
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-secondary">Save</button>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mb-3">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="filled" value="1">
                            <div class="card-header">
                                <h4>Profile </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="public_name">Public name</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="public_name" id="public_name" value="{{ $user->profile->public_name }}">
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="work_org">Working organization</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="work_org" id="work_org" value="{{ $user->profile->work_org }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="work_dep">Working Department</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="work_dep" id="work_dep" value="{{ $user->profile->work_dep }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="work_job">Job</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="work_job" id="work_job" value="{{ $user->profile->work_job }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="bio">Bio</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" rows="5" name="bio" id="bio">{{ $user->profile->bio }}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="address_1">Address 1</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="address_1" id="address_1" value="{{ $user->profile->address_1 }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="address_2">Address 2</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="address_2" id="address_2" value="{{ $user->profile->address_2 }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="keywords">Specializations / Activities</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="keywords" id="keywords" value="{{ $user->profile->keywords }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="birth_date">Date of birth</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ $user->profile->birth_date }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-secondary">Save</button>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mb-3">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="links" value="1">
                            <div class="card-header">
                                <h4>Social links </h4>
                            </div>
                            <div class="card-body">
                                @php($links = (json_decode($user->profile->social_links)))
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="gs_profile">Google Scholar profile</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="gs_profile" id="gs_profile" value="{{ $user->gs_profile }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="orcid">ORCID</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="orcid" id="orcid" value="{{ $user->orcid }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="fb">Facebook</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="social_links[facebook]" id="fb" value="{{ $links != '' ? $links->facebook : '' }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="in">Linkedin</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="social_links[linkedin]" id="in" value="{{ $links != '' ? $links->linkedin : '' }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="twitter">Twitter</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="social_links[twitter]" id="twitter" value="{{ $links != '' ? $links->twitter: '' }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"><label for="telegram">Telegram</label></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="social_links[telegram]" id="telegram" value="{{ $links != '' ? $links->telegram : '' }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-secondary">Save</button>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
