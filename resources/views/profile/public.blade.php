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
                                    <img src="{{ asset('images/icons/no_gender_avatar.png') }}" alt="default profile image" class="rounded-circle" width="150" height="150">
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

                                        <p class="text-muted">
                                            @if($links != '')
                                                @foreach($links as $key => $link)
                                                    @if($link != '')
                                                        <a title="{{ $key }}" href="{{ $link }}"><img class=" m-1" src="{{ asset('images/icons/social/'.$key.'.png') }}" alt="{{ $key }} icon"></a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row gutters-sm text-center">

                        @if($user->scholarProfile)
                            <div class="col-sm-12 mb-3">
                                <div class="card h-100 border-5 border-primary">
                                    <div class="card-header bg-primary">
                                        <h3 class="text-white">Google Scholar</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <img width="128px" src="{{ $user->scholarProfile->avatar }}" alt="Google scholar"
                                                     class="rounded-circle">
                                            </div>
                                            <div class="col-10">
                                                <h3>{{ $user->scholarProfile->name }}</h3>
                                                <p><b>{{ $user->scholarProfile->organization }}</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2 border-primary">
                                    <div class="card-body">
                                        <strong>Google Scholar H-index</strong>
                                        <h1>{{ $user->scholarProfile->h_index }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2 border-primary">
                                    <div class="card-body">
                                        <strong>Google Scholar i10-index</strong>
                                        <h1>{{ $user->scholarProfile->i10_index }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2 border-primary">
                                    <div class="card-body">
                                        <strong>Google Scholar Citations</strong>
                                        <h1>{{ $user->scholarProfile->citations }}</h1>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12" role="alert">
                                <div class="alert-dismissible alert fade show bg-primary">
                                    <h6 class="text-white">
                                        Пользователь не добавил ссылку на профиль в Google Scholar
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row gutters-sm text-center">
                        @if($user->scholarProfile && json_decode($user->scholarProfile->by_year))
                            <div class="col-sm-12 mb-3  h-100 ">
                                <div class="card border-2 border-primary">
                                    <div id="scholar"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row gutters-sm text-center">
                        @if($user->publonsProfile)
                            <div class="col-sm-12 mb-3">
                                <div class="card h-100 border-5" style="border-color: #346595">
                                    <div class="card-header" style="background-color: #346595">
                                        <h3 class="text-white">Publons</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{ $user->publonsProfile->avatar }}" alt="Publons avatar"
                                                     class="rounded-circle">
                                            </div>
                                            <div class="col-10">
                                                <h3>{{ $user->publonsProfile->publons_user_name }}</h3>
                                                <p><b>
                                                        @if($user->publonsProfile->institutions)
                                                            {{ json_decode($user->publonsProfile->institutions, true)[0]['name'] }}
                                                        @else
                                                            <span class="text-danger">Организация в профиле Publons не добавлена</span>
                                                        @endif
                                                    </b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2" style="border-color: #346595">
                                    <div class="card-body">
                                        <strong>Web Of Science publications</strong>
                                        <h1>{{ $user->publonsProfile->publications_count }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2" style="border-color: #346595">
                                    <div class="card-body">
                                        <strong>Web Of Science H-index</strong>
                                        <h1>
                                            @isset($user->publonsProfile->h_index)
                                                {{ $user->publonsProfile->h_index }}
                                            @else
                                                <i class="fa fa-eye-slash"></i>
                                            @endisset
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2" style="border-color: #346595">
                                    <div class="card-body">
                                        <strong>Web Of Science Citations</strong>

                                        <h1>
                                            @isset($user->publonsProfile->citations)
                                                {{ $user->publonsProfile->citations }}
                                            @else
                                                <i class="fa fa-eye-slash"></i>
                                            @endisset
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            @if($user->publonsProfile->publication_stats and $user->publonsProfile->publications_count > 0)
                                <div class="col-12 mb-3">
                                    <div class="card border-2" style="border-color: #346595">
                                        <div id="wos_chart" style="width: 100%; height: 500px;"></div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-12" role="alert">
                                <div class="alert-dismissible alert fade show" style="background-color: #346595">
                                    <h6 class="text-white">
                                        Пользователь не добавил ссылку на профиль в Publons (Web Of Science)
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row gutters-sm text-center">
                        @if($user->scopusProfile)
                            <div class="col-sm-12 mb-3">
                                <div class="card h-100 border-5" style="border-color: #fe8200">
                                    <div class="card-header" style="background-color: #fe8200">
                                        <h3 class="text-white">Scopus</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $user->scopusProfile->full_name }}</h3>
                                        <p><b>{{ $user->scopusProfile->institution }}</b></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 mb-3">
                                <div class="card border-2" style="border-color: #fe8200">
                                    <div class="card-body">
                                        <strong>Scopus publications</strong>
                                        <h1>{{ $user->scopusProfile->documents_count }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2" style="border-color: #fe8200">
                                    <div class="card-body">
                                        <strong>Scopus H-index</strong>
                                        <h1>
                                            @isset($user->scopusProfile->h_index)
                                                {{ $user->scopusProfile->h_index }}
                                            @else
                                                <i class="fa fa-eye-slash"></i>
                                            @endisset
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card border-2" style="border-color: #fe8200">
                                    <div class="card-body">
                                        <strong>Scopus Citations</strong>
                                        <h1>
                                            @isset($user->scopusProfile->citations_count)
                                                {{ $user->scopusProfile->citations_count }}
                                            @else
                                                <i class="fa fa-eye-slash"></i>
                                            @endisset
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            @if($user->scopusProfile->chart and $user->scopusProfile->documents_count > 0)
                                <div class="col-12 mb-3">
                                    <div class="card border-2" style="border-color: #fe8200">
                                        <div id="scopus_chart" style="width: 100%; height: 500px;"></div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-12" role="alert">
                                <div class="alert-dismissible alert fade show" style="background-color: #fe8200">
                                    <h6 class="text-white">
                                        Пользователь не добавил ссылку на профиль в Scopus (Elsevier).
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    @foreach($user->submissions as $sub)
                        @php($details = $sub->localizedDetails(app()->getLocale()))
                        <div class="card mb-3">
                            <div class="card-body">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if($user->scholarProfile && json_decode($user->scholarProfile->by_year))
        <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            @if($user->scholarProfile)
            // Draw the chart and set the chart values
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Number of citations'],

                        @foreach(json_decode($user->scholarProfile->by_year, true) as $year => $cit)
                    ['{{ $year }}', {{ $cit }}],
                    @endforeach

                ]);

                // Optional; add a title and set the width and height of the chart
                var options = {'title':'Google scholar citations', 'height': 300, legend: {position: 'top', textStyle: {fontSize: 16}}};

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
    @endif

    @if($user->publonsProfile and $user->publonsProfile->publication_stats and $user->publonsProfile->publications_count > 0)
        <script type="text/javascript">
            @php($wos_citations = json_decode($user->publonsProfile->publication_stats, true))

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
                // Some raw data (not necessarily accurate)
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Publications', 'Citations'],
                        @foreach($wos_citations['labels'] as $key => $year)
                    [
                        '{{ $year }}',
                        {{ $wos_citations['series'][0]['data'][$key] }},
                        {{ $wos_citations['series'][1]['data'][$key] }}
                    ],
                    @endforeach
                ]);

                var options = {
                    title : 'Web of Science citations graph',
                    // vAxis: {title: 'Cups'},
                    // hAxis: {title: 'Month'},
                    seriesType: 'bars',
                    series: {
                        0: {
                            targetAxisIndex: 0
                        },
                        1: {
                            type: 'line',
                            targetAxisIndex: 1
                        },
                    },
                    legend: {position: 'top', textStyle: {fontSize: 16}}
                };

                var chart = new google.visualization.ComboChart(document.getElementById('wos_chart'));
                chart.draw(data, options);
            }
        </script>
    @endif


    @if($user->scopusProfile and $user->scopusProfile->chart and $user->scopusProfile->documents_count > 0)
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
                // Some raw data (not necessarily accurate)
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Publications', 'Citations'],
                        @foreach($user->scopusProfile->getChart() as $year => $data_by_year)
                    [
                        '{{ $year }}',
                        {{ $data_by_year[0] }},
                        {{ $data_by_year[1] }}
                    ],
                    @endforeach
                ]);

                var options = {
                    title : 'Scopus citations graph',
                    // vAxis: {title: 'Cups'},
                    // hAxis: {title: 'Month'},
                    seriesType: 'bars',
                    series: {
                        0: {
                            targetAxisIndex: 0
                        },
                        1: {
                            type: 'line',
                            targetAxisIndex: 1
                        },
                    },
                    legend: {position: 'top', textStyle: {fontSize: 16}}
                };

                var chart = new google.visualization.ComboChart(document.getElementById('scopus_chart'));
                chart.draw(data, options);
            }
        </script>
    @endif
@endsection
