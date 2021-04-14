@extends('layouts.app')

@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row">
                <h3><b>Start new papers collection event</b></h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dolor laboriosam qui. Assumenda at, deleniti deserunt dolor ducimus eum hic iure molestias obcaecati, placeat repellat repudiandae rerum sapiente unde vel.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, corporis dolore dolores nam porro ratione voluptate. A adipisci alias autem commodi consequuntur deleniti dolores eveniet nisi, optio quam repudiandae ullam.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus asperiores atque aut dolor enim eum, fugiat laboriosam libero optio praesentium quidem quo quos recusandae saepe ullam unde velit voluptas voluptatum?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam consectetur eaque eos expedita iusto libero minima, nesciunt odio placeat repudiandae rerum temporibus. Autem dolorum eligendi minus numquam rem saepe vel!
                </p>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 centered">
                                    <div class="card shadow">
                                        <a href="{{ route('conference.create') }}">
                                            <div class="card-body">
                                                <h5>Start new conference papers collection event</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 centered">
                                    <div class="card shadow">
                                        <a href="{{ route('journal.create') }}">
                                            <div class="card-body">
                                                <h5>Start new journal articles collection event</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
