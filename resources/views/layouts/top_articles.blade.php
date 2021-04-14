<!-- Reputation Section Two -->
<div class="reputation-section-two style-two">
    <div class="auto-container">
        <div class="sec-title">
            <h2><span>ТОП</span> публикации</h2>
        </div>
        <div class="row clearfix">
            <div class="col-md-6">
                <h3><strong>Рекомендуется</strong></h3>
                @foreach($submissions as $sub)
                    @php($details = $sub->localizedDetails(app()->getLocale()))
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                {{--                            <div class="col-sm-3"><a href="#" class=""><img src="http://placehold.it/720x1024" class="img-responsive"></a>--}}
                                {{--                            </div>--}}
                                <div class="col-sm-12 pt-2">
                                    <div class="px-2">
                                        <a href="/">
                                            <h5 class="title">
                                                @isset($details->flags['title'])
                                                    <img
                                                        src="{{ asset('images/icons/flags/' .$details->flags['title']. '-32.png') }}"
                                                        alt="" width="14">
                                                @endisset {{ strlen($details->title) > 100 ? mb_substr($details->title, 0, 100, 'utf-8') . '...': $details->title }}</h5>
                                        </a>
                                        <p class="text-muted"><i class="fa fa-calendar"></i> {{ $sub->published_at->format('Y') }}. <i class="fa fa-book-dead"></i> {{ $details->publisher }}</p>
                                        <p>
                                            @isset($details->flags['abstract'])
                                                <img
                                                    src="{{ asset('images/icons/flags/' .$details->flags['abstract']. '-32.png') }}"
                                                    alt="" width="14">
                                            @endisset{{ strlen($details->abstract) > 250 ? mb_substr($details->abstract, 0, 250, 'utf-8') . '...': $details->abstract }}
                                        </p>
                                        <p class="text-muted">Доступен в
                                            <a class="mx-1" href="{{ config('services.orcid.url') . '/' }}"><img src="{{ asset('images/icons/social/orcid.png') }}" width="20" alt="orcid icon"></a>
                                            <a class="mx-1" href=""><img src="{{ asset('images/icons/social/google_scholar.png') }}" width="20" alt="google_scholar icon"></a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <h3><strong>Популярные</strong></h3>
                @foreach($submissions as $sub)
                    @php($details = $sub->localizedDetails(app()->getLocale()))
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                {{--                            <div class="col-sm-3"><a href="#" class=""><img src="http://placehold.it/720x1024" class="img-responsive"></a>--}}
                                {{--                            </div>--}}
                                <div class="col-sm-12 pt-2">
                                    <div class="px-2">
                                        <a href="{{ route('publication.show', $sub->id) }}">
                                            <h5 class="title">
                                                @isset($details->flags['title'])
                                                    <img
                                                        src="{{ asset('images/icons/flags/' .$details->flags['title']. '-32.png') }}"
                                                        alt="" width="14">
                                                @endisset {{ strlen($details->title) > 100 ? mb_substr($details->title, 0, 100, 'utf-8') . '...': $details->title }}</h5>
                                        </a>
                                        <p class="text-muted"><i class="fa fa-calendar"></i> {{ $sub->published_at->format('Y') }}. <i class="fa fa-book-dead"></i> {{ $details->publisher }}</p>
                                        <p>
                                            @isset($details->flags['abstract'])
                                                <img
                                                    src="{{ asset('images/icons/flags/' .$details->flags['abstract']. '-32.png') }}"
                                                    alt="" width="14">
                                            @endisset{{ strlen($details->abstract) > 250 ? mb_substr($details->abstract, 0, 250, 'utf-8') . '...': $details->abstract }}
                                        </p>
                                        <p class="text-muted">Доступен в
                                            <a class="mx-1" href="{{ config('services.orcid.url') . '/' }}"><img src="{{ asset('images/icons/social/orcid.png') }}" width="20" alt="orcid icon"></a>
                                            <a class="mx-1" href=""><img src="{{ asset('images/icons/social/google_scholar.png') }}" width="20" alt="google_scholar icon"></a>
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
<!-- End Reputation Section -->
