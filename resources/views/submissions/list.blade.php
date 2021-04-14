@extends('layouts.app')
@section('title')| {{ $user->first_name }} {{ $user->last_name }} {{ $user->middle_name }}@endsection
@section('styles')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

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
                                    <h4>{{ $user->first_name }} {{ $user->last_name }} {{ $user->middle_name }}</h4>
                                    @if($user->profile)
                                        @php($links = json_decode($user->profile->social_links))
                                        <p class="text-secondary mb-1">{{ $user->profile->work_job }} of {{ $user->profile->work_dep }}</p>
                                        <p class="text-muted font-size-sm">At {{ $user->profile->work_org }}</p>
                                        <p class="text-muted font-size-sm">
                                            @if($user->orcid)
                                                <a class="mx-1" href="{{ config('services.orcid.url') . '/' . $user->orcid }}"><img src="{{ asset('images/icons/social/orcid.png') }}" alt="orcid icon"></a>
                                            @endif
                                            @if($user->gs_profile)
                                                <a class="mx-1" href="{{ $user->gs_profile }}"><img src="{{ asset('images/icons/social/google_scholar.png') }}" alt="google_scholar icon"></a>
                                            @endif
                                            @if($links != '')
                                                @foreach($links as $key => $link)
                                                    @if($link != '')
                                                        <a class="mx-1" href="{{ $link }}"><img src="{{ asset('images/icons/social/'.$key.'.png') }}" alt="{{ $key }} icon"></a>
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{--                                            <a class="mx-1" href="{{ config('services.orcid.url') . '/' . $user->orcid }}"><img src="{{ asset('images/icons/social/facebook.png') }}" alt="facebook icon"></a>--}}
                                            {{--                                            <a class="mx-1" href="{{ config('services.orcid.url') . '/' . $user->orcid }}"><img src="{{ asset('images/icons/social/twitter.png') }}" alt="twitter icon"></a>--}}
                                            {{--                                            <a class="mx-1" href="{{ config('services.orcid.url') . '/' . $user->orcid }}"><img src="{{ asset('images/icons/social/telegram.png') }}" alt="telegram icon"></a>--}}
                                        </p>
                                        {{--                                        <button class="btn btn-primary">Follow</button>--}}
                                        {{--                                        <button class="btn btn-outline-primary">Message</button>--}}
                                    @else
                                        Please fill your profile
                                        <button class="btn btn-primary">Fill in the profile</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('profile.profile_menu')
                </div>
                <div class="col-md-8">
                    <div class="row gutters-sm text-center">
                        <div class="col-sm-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <strong>Scienceweb H-index</strong>
                                    <h1>12</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <strong>Scienceweb i10-index</strong>
                                    <h1>15</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <strong>Scienceweb Citations</strong>
                                    <h1>45</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gutters-sm text-center">
                        @if($user->gs_profile)
                            <div class="col-sm-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <strong>Google Scholar H-index</strong>
                                        <h1>{{ $user->scholarProfile->h_index }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <strong>Google Scholar i10-index</strong>
                                        <h1>{{ $user->scholarProfile->i10_index }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <strong>Google Scholar Citations</strong>
                                        <h1>{{ $user->scholarProfile->citations }}</h1>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-muted">No Google scholar profile data</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row gutters-sm text-center">
                        @if($user->gs_profile)
                            <div class="col-sm-12 mb-3">
                                <div id="scholar"></div>
                            </div>
                        @endif

                        {{--                        <div class="col-sm-6 mb-3">--}}
                        {{--                            <div id="scienceweb"></div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Specializations / Activities</p>
                                </div>
                                <div class="col-sm-9">
                                    <p><strong>{{ $user->profile->keywords }}</strong></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Bio</p>
                                </div>
                                <div class="col-sm-9">
                                    {!! $user->profile->bio !!}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p><strong>{{ $user->email }}</strong></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p><strong>{{ $user->phone }}</strong></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p><strong>{{ $user->profile->address_1 }}, {{ $user->state }}, {{ $user->country->name }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                            <small>Web Design</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Website Markup</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>One Page</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Mobile Template</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Backend API</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                            <small>Web Design</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Website Markup</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>One Page</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Mobile Template</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Backend API</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Number of citations'],
                    @foreach(json_decode($user->scholarProfile->by_year, true) as $year => $cit)
                ['{{ $year }}', {{ $cit }}],
                @endforeach
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {'title':'Google scholar citations', 'height': 300};

            // var sciencewebData = google.visualization.arrayToDataTable([
            //     ['Task', 'Number of citations'],
            //     ['2017', 136],
            //     ['2018', 188],
            //     ['2019', 190],
            //     ['2020', 204],
            //     ['2021', 30],
            // ]);

            // Optional; add a title and set the width and height of the chart
            var sciencewebOptions = {'title':'Scienceweb citations', 'height': 300};

            // Display the chart inside the <div> element with id="piechart"
            var scholar = new google.visualization.ColumnChart(document.getElementById('scholar'));
            // var scienceweb = new google.visualization.ColumnChart(document.getElementById('scienceweb'));
            scholar.draw(data, options);
            // scienceweb.draw(sciencewebData, sciencewebOptions);
        }
    </script>
@endsection
