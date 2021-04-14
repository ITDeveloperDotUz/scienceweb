@extends('layouts.app')

@section('title',$page->title or 'Title')
@section('content')
    <div class="auto-container">

        <div class="row">
            <div class="col-12 sec-title">
                <div class="clearfix">
                    <div class="pull-left">
{{--                        <h2><span>Связаться с нами</span></h2>--}}
                        <h2><span>{{ $page->title }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-9">
                {!! $page->content !!}

            </div>
        </div>
    </div>
@endsection
