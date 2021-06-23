@extends('layouts.app')

@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered  align-middle">
                        <thead>
                        <tr>
                            <th scope="col">Avatar</th>
                            <th scope="col">Имя автора</th>
                            <th scope="col">Публикации</th>
                            <th scope="col">Google Scholar</th>
                            <th scope="col">Publons</th>
                            <th scope="col">ORCID</th>
                            <th scope="col">Scopus</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profiles as $profile)
                            @php($links = json_decode($profile->social_links))
                            <tr>
                                <th scope="row">
                                    @if($profile->avatar)
                                        <img src="/{{ $profile->avatar }}" alt="" width="50" height="50">
                                    @else
                                        <img src="{{ asset('images/icons/no_gender.png') }}" alt="" width="50" height="50">
                                    @endisset
                                </th>
                                <td>
                                    @if($profile->public_name)

                                        @if($profile->user->orcid)
                                            <a href="/{{ $profile->user->orcid }}">
                                                <h5>{{ $profile->public_name }}</h5>
                                            </a>
                                        @else
                                            <h5>{{ $profile->public_name }}</h5>
                                        @endif
                                    @else
                                        <h5>{{ $profile->user->first_name }} {{ $profile->user->last_name }} {{ $profile->user->middle_name }}</h5>
                                    @endisset
                                    {{ $profile->work_org }}
                                </td>
                                <td><b>{{ $profile->user->submissions->count() }}</b></td>
                                <td>
                                    @if(isset($links->google_scholar) or $profile->user->gs_profile)
                                        <a title="google_scholar" href="https://scholar.google.com/citations?user={{ $profile->user->gs_profile }}"><img class=" m-1" src="{{ asset('images/icons/social/google_scholar.png') }}" alt="google_scholar icon"></a>
                                    @endif
                                </td>
                                <td>
                                    @isset($links->publons)
                                        <a title="publons" href="{{ $links->publons }}"><img class=" m-1" src="{{ asset('images/icons/social/publons.png') }}" alt="publons icon"></a>
                                    @endisset
                                </td>
                                <td>
                                    @if(isset($links->orcid) or $profile->user->orcid)
                                        <a title="orcid" href="https://orcid.org/{{ $profile->user->orcid }}"><img class=" m-1" src="{{ asset('images/icons/social/orcid.png') }}" alt="orcid icon"></a>
                                    @endif
                                </td>
                                <td>
                                    @isset($links->scopus)
                                        <a title="scopus" href="{{ $links->scopus }}"><img class=" m-1" src="{{ asset('images/icons/social/scopus.png') }}" alt="scopus icon"></a>
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
