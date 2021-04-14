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
                                    @if($user->profile->filled)
                                        @php($links = json_decode($user->profile->social_links))
                                            <p class="text-secondary mb-1">
                                                @if($user->profile->work_job)
                                                    {{ $user->profile->work_job }} of
                                                @endif
                                                @if($user->profile->work_dep)
                                                    {{ $user->profile->work_dep }}
                                                @endif
                                            </p>
                                        @if($user->profile->work_org)
                                            <p class="text-muted font-size-sm">{{ $user->profile->work_org }}</p>
                                        @endif

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
                                        <a  class="btn btn-warning" href="{{ route('profile.edit') }}">Fill in the profile</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('profile.user_menu')
                    <div class="card mt-3">
                        <div class="card-body">
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <p class="mb-0">Tariff</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <p><strong>{{ $user->tariff[0]->name }}</strong></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="mb-0">Specializations / Activities</p>
                                </div>
                                <div class="col-sm-12">
                                    <p><strong>{{ $user->profile->keywords }}</strong></p>
                                </div>
                            </div>
                            {{--                            <hr>--}}
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-sm-3">--}}
                            {{--                                    <p class="mb-0">Bio</p>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-sm-9">--}}
                            {{--                                    {!! $user->profile->bio !!}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-12">
                                    <p><strong>{{ $user->email }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-12">
                                    <p><strong>{{ $user->phone }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-12">
                                    <p><strong>{{ $user->profile->address_1 }}, {{ $user->state }}, {{ $user->country->name }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        @if($user->scholarProfile)
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
                        @if($user->scholarProfile)
                            <div class="col-sm-12 mb-3">
                                <div id="scholar"></div>
                            </div>
                        @endif

{{--                        <div class="col-sm-6 mb-3">--}}
{{--                            <div id="scienceweb"></div>--}}
{{--                        </div>--}}
                    </div>


                    @foreach($user->submissions as $sub)
                        @php($details = $sub->localizedDetails(app()->getLocale()))
                        <div class="card mb-3">
                            <div class="card-header">
                                @can('update submission')
                                    <a href="{{ route('submission.edit', $sub->id) }}" class="btn btn-default btn-outline-warning"><i class="fa fa-pencil-alt"></i> Edit</a>
                                @endcan
                                @can('delete submission')
                                    <button class="btn btn-outline-danger" onclick="$('form#delete_{{ $sub->id }}').submit()"><i class="fa fa-trash"></i> Delete</button>
                                    <form action="{{ route('submission.destroy', $sub->id) }}" method="post" id="delete_{{ $sub->id }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                @endcan

                            </div>
                            <div class="row">
                                <div class="col-sm-3"><a href="#" class="">
                                    @if($sub->thumb)
                                        <a href="{{ route('submission.show', $sub->id) }}" class=""><img src="{{ url($sub->thumb) }}" class="img-responsive"></a>
                                    @else
                                        <a href="{{ route('submission.show', $sub->id) }}" class=""><img src="{{ asset('/images/resource/journal_pl.png') }}" class="img-responsive"></a>
                                    @endif
                                </div>
                                <div class="col-sm-9 pt-2">
                                    <div class="px-2">
                                        <a href="{{ route('submission.show', $sub->id) }}"><h5 class="title">
                                                @isset($details->flags['title'])
                                                    <img
                                                        src="{{ asset('images/icons/flags/' .$details->flags['title']. '-32.png') }}"
                                                        alt="" width="14">
                                                @endisset {{ strlen($details->title) > 100 ? mb_substr($details->title, 0, 100, 'utf-8') . '...': $details->title }}</h5></a>
                                        <p class="text-muted"><i class="fa fa-calendar"></i> {{ $sub->published_at->format('Y-m-d') }}. <i class="fa fa-book-dead"></i> {{ $details->publisher }}</p>
                                        <p>
                                            @isset($details->flags['abstract'])
                                                <img
                                                    src="{{ asset('images/icons/flags/' .$details->flags['abstract']. '-32.png') }}"
                                                    alt="" width="14">
                                            @endisset{{ strlen($details->abstract) > 250 ? substr($details->abstract, 0, 180) . '...': $details->abstract }}
                                        </p>
                                        <p class="text-muted">Доступен в
                                            @if($user->orcid)
                                                <a class="mx-1" href="{{ config('services.orcid.url') . '/' . $user->orcid }}"><img src="{{ asset('images/icons/social/orcid.png') }}" width="20" alt="orcid icon"></a>
                                            @endif
                                            @if($user->gs_profile)
                                                <a class="mx-1" href="{{ $user->gs_profile }}"><img src="{{ asset('images/icons/social/google_scholar.png') }}" width="20" alt="google_scholar icon"></a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
        @if($user->scholarProfile)
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
        @endif

    </script>
@endsection
