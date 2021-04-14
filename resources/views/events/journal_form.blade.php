@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('css/choosen/chosen.css') }}">
@endsection
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
                        <div class="card-body consult-form">
                            <form action="{{ url('/') }}">
                                @csrf

                                <input type="hidden" name="type" value="journal">
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label class="" for="volume"><b>Том / Номер</b></label>
                                    </div>
                                    <div class="col-4">
                                        <input name="volume" id="volume" type="number" >
                                    </div>
                                    <div class="col-4">
                                        <input name="number" id="number" type="number" >
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label class="" for="title"><b>Название</b></label>
                                    </div>
                                    <div class="col-8">
                                        <input name="title" id="title" type="text" >
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="category"><b>Категория</b></label>
                                    </div>
                                    <div class="col-8 my-1 ">
                                        <select class="form-select chosen-select" tabindex="17" name="category" id="category">
                                            @foreach($categories as $c)
                                                {{ $cd = $c->localizedDetails(app()->getLocale()) }}
                                                <option value="{{ $c->id }}">{{ $cd->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="start_date"><b>Дата начала/конца</b></label>
                                    </div>
                                    <div class="col-4">
                                        <input name="start_date" id="start_date" type="date" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <input name="end_date" id="end_date" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="sub_start_date"><b>Дата начала/конца принятия материалов</b></label>
                                    </div>
                                    <div class="col-4">
                                        <input name="sub_start_date" id="sub_start_date" type="date" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <input name="submission_deadline" id="submission_deadline" type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="publisher"><b>Издатель</b></label>
                                    </div>
                                    <div class="col-8">
                                        <input name="publisher" id="publisher" type="text" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="description"><b>Краткое описание</b></label>
                                    </div>
                                    <div class="col-8">
                                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="long_description"><b>Подробное описание</b></label>
                                    </div>
                                    <div class="col-8">
                                        <textarea name="long_description" id="long_description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 my-auto">
                                        <label for="additional_info"><b>Дополнительная информация</b></label>
                                    </div>
                                    <div class="col-8">
                                        <textarea name="additional_info" id="additional_info" cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-dark">Сохранить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script>
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : { allow_single_deselect: true },
            '.chosen-select-no-single' : { disable_search_threshold: 10 },
            '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
            '.chosen-select-rtl'       : { rtl: true },
            '.chosen-select-width'     : { width: '95%' }
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>
@endsection
