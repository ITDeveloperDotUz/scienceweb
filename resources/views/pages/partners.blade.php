@extends('layouts.app')

@section('content')
    <div class="auto-container">
        <div class="row">
            <div class="col-12 sec-title">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>Список <span>издателей</span></h2>
                    </div>
                </div>
            </div>
            @foreach($publishers as $publisher)
                <div class="service-block style-two col-lg-4 col-md-6 col-12">
                    <div class="inner-box">
                        <div class="icon-box">
                            <span class="icon ti-pie-chart"></span>
                        </div>
                        <h5><a href="/">{{ $publisher->name }}</a></h5>
                        <div class="text"></div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
@endsection
