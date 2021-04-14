@extends('layouts.app')
@section('styles')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    @include('profile.publisher_menu')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h3>{{ $user->name }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center mt-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="mb-1"><strong>Books</strong></h5>
                                    <h2 class="mb-1"><strong>156</strong></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center mt-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="mb-1"><strong>Conferences</strong></h5>
                                    <h2 class="mb-1"><strong>302</strong></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center mt-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="mb-1"><strong>Journals</strong></h5>
                                    <h2 class="mb-1"><strong>84</strong></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <h4>My events</h4>
                        </div>
                        <div class="card-body">
                            @foreach($events as $event)
                                <p>{{ $event->localizedDetails()->title }}</p>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

