@extends('layouts.app')


@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-9">
                    @foreach($events as $event)
                        @php($details = $event->localizedDetails())
                        <div class="card mb-3">
                            <div class="card-body">
                                <a href="{{$event->link}}">
                                    <h5 class="title">{{ $details->title }}</h5>
                                </a>
                                <p class="text-muted"><i class="fa fa-calendar"></i> {{ $event->start_date->format('F d').'-'.$event->end_date->format('d Y') }}. <i class="fa fa-location-arrow"></i> {{ $details->city }}</p>
                                <div class="">
                                    {!! def($details->description) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $events->onEachSide(3)->links() }}
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Categories</h5>
                        </div>
                        <ul class="list-group">
                            @foreach($categories as $category)
                                <li class="list-group-item">
                                    <a href="">{{ $category->localizedDetails(app()->getLocale())->name }}</a>
                                </li>
                            @endforeach
                        </ul>
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

