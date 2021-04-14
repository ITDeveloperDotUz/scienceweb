@extends('layouts.app')
@php($defaultDetails = $publication->localizedDetails($publication->locale))
@section('title', def($publication->author->profile->public_name, $publication->author->first_name . ' ' . $publication->author->last_name) . ': ' . $details->title)
@section('page-description', $details->abstract)
@section('page-keywords', $details->keywords)
@section('meta')
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6065cc38f6067000116b09b1&product=inline-share-buttons" async="async"></script>

    @foreach($publication->citationMetaTags() as $tag)
        {!! $tag !!}
    @endforeach
    @foreach($publication->dcMetaTags() as $tag)
        {!! $tag !!}
    @endforeach
@endsection

@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row gutters-sm">
                <h2 style="line-height: initial" class="mb-3"><strong>{{ $details->title }}</strong></h2>
                <div class="col-md-3">
                    @if($publication->thumb)
                        <img src="{{ url($publication->thumb) }}" class="img-responsive">
                    @else
                        <img src="{{ asset('/images/resource/journal_pl.png') }}" class="img-responsive">
                    @endif
                    <div class="text-center mt-3">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                    @if($publication->author->can('add reference-to-submission'))
                        <div class="card my-3">
                            <div class="card-header">
                                <h5>Цитировать</h5>
                            </div>
                            <div class="card-body" id="citationBlock">
                                {!! $cite !!}
                            </div>
                            <div class="card-footer">
                                @foreach($citationStyles as $style => $name)
                                    <button onclick="loadCitationStyle('{{ $style }}')" class="btn btn-sm btn-link">{{ $name }}</button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-9 article-details">
                    <p><b>Авторы:</b>
                        @if($publication->author->profile)
                            {{ def($publication->author->profile->public_name, $publication->author->first_name . ' ' . $publication->author->last_name) }}
                        @endif
                        @if($publication->coauthors)
                            @foreach($publication->coauthors as $author)
                                @if($author->profile)
                                    {{ def($author->profile->public_name, $author->first_name . ' ' . $author->last_name) }}
                                @else
                                    {{ ', ' . $author->first_name . ' ' . $author->last_name }}
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p><b><i class="fa fa-eye"></i> Просмотры:</b> 13256, <b><i class="fa fa-file"></i> Страницы:</b> 10, <b><i class="fa fa-file-download"></i> Файлы:</b> 1</p>
                    <p><b><i class="fa fa-calendar-alt"></i> Год публикации:</b> {{ $publication->published_at->format('Y') }}</p>

                    <p><b>Издатель:</b> {{ $details->publisher }}</p>
                    <p><b>DOI:</b> {{ $publication->doi }}</p>
                    <p><b>Ключевые слова:</b>
                        @foreach(explode(', ', $details->keywords) as $kw)
                            <a class="px-2 btn-sm btn-success">{{ $kw }}</a>
                        @endforeach
                    </p>
                    <div class="card my-3" id="myTab" role="tablist">
                        <ul class="nav nav-pills nav-fill"  role="presentation">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    id="abstract-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#abstract"
                                    type="button"
                                    role="tab"
                                    aria-controls="abstract"
                                    aria-selected="true">
                                    Abstract & Preview
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a--}}
{{--                                    class="nav-link "--}}
{{--                                    id="files-tab"--}}
{{--                                    data-bs-toggle="tab"--}}
{{--                                    data-bs-target="#files"--}}
{{--                                    type="button"--}}
{{--                                    role="tab"--}}
{{--                                    aria-controls="files"--}}
{{--                                    aria-selected="true">--}}
{{--                                    Files--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a--}}
{{--                                    class="nav-link "--}}
{{--                                    id="discussion-tab"--}}
{{--                                    data-bs-toggle="tab"--}}
{{--                                    data-bs-target="#discussion"--}}
{{--                                    type="button"--}}
{{--                                    role="tab"--}}
{{--                                    aria-controls="discussion"--}}
{{--                                    aria-selected="true">--}}
{{--                                    Discussion--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            @if($publication->author->tariff[0]->slug == 'premium')
                                <li class="nav-item">
                                    <a
                                        class="nav-link "
                                        id="references-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#references"
                                        type="button"
                                        role="tab"
                                        aria-controls="references"
                                        aria-selected="true">
                                        References
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link "
                                        id="citations-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#citations"
                                        type="button"
                                        role="tab"
                                        aria-controls="citations"
                                        aria-selected="true">
                                        Citations
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="metrics-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#metrics"
                                    type="button"
                                    role="tab"
                                    aria-controls="metrics"
                                    aria-selected="true">
                                    Metrics
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="abstract" role="tabpanel" aria-labelledby="abstract-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Abstract & Preview</h5>
                                </div>
                                <div class="card-body">
                                    <p class="abstract">
                                        <i>{{ $details->abstract }}</i>
                                    </p>
                                </div>
                                <iframe src="{{ url($publication->preview ? $publication->preview: $publication->file) }}#toolbar=0" width="100%" height="800"></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
                            <div class="card my-3">
                                <div class="card-header">
                                    <h5>Files</h5>
                                </div>
                                <ul class="list-group">
                                    @foreach($publication->references as $citation)
                                        <li class="list-group-item">
                                            {{ $citation->citation }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discussion" role="tabpanel" aria-labelledby="discussion-tab">
                            <div class="card my-3">
                                <div class="card-header">
                                    <h5>Files</h5>
                                </div>
                                <ul class="list-group">
                                    @foreach($publication->references as $citation)
                                        <li class="list-group-item">
                                            {{ $citation->citation }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="references" role="tabpanel" aria-labelledby="references-tab">
                            <div class="card my-3">
                                <div class="card-header">
                                    <h5>Литература</h5>
                                </div>
                                <ul class="list-group">
                                    @foreach($publication->references as $citation)
                                        <li class="list-group-item">
                                            {{ $citation->citation }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="citations" role="tabpanel" aria-labelledby="citations-tab">
                            <div class="card my-3">
                                <div class="card-header">
                                    <h5>Цитирования</h5>
                                </div>
                                <ul class="list-group">

                                    @foreach($publication->references as $citation)
                                        <li class="list-group-item">
                                            {{ $citation->citation }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="metrics" role="tabpanel" aria-labelledby="metrics-tab">
                            <div class="row gutters-sm text-center">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong><i class="fa fa-eye"></i> Просмотры</strong>
                                            <h3>1300</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong><i class="fa fa-book-reader"></i> Читатели</strong>
                                            <h3>4</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong><i class="fa fa-quote-right"></i> Цитирование</strong>
                                            <h3>123</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong><i class="fa fa-star"></i> Рейтинг</strong>
                                            <h3>132001</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">

                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function loadCitationStyle(style){
            $.ajax({
                url: "{{ url('submission/citation-style', $publication->id) }}/" + style,
                success: function(result){
                    $("#citationBlock").html(result)
                    // console.log(result)
                }
            })
        }
    </script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dc3bd740b02244b"></script>

@endsection
