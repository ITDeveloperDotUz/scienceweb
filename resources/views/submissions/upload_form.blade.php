@extends('layouts.app')


@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-12 ">
                    <div class="consult-form">
                        <form action="{{ route('submission.upload') }}" enctype="multipart/form-data" method="post">
                            @method('POST')
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-2 my-auto">
                                            <label for="locale"><strong>Язык</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="locale" id="locale">
                                                @foreach(config('app.locales') as $locale)
                                                    <option value="{{ $locale }}">{{ __('site.locales.'.$locale) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2 my-auto">
                                            <label for="file"><strong>Файл публикации</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control" id="file" type="file" name="submission_file" required accept="application/pdf">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-2 my-auto">
                                            <label for="thumbnail"><strong>Титульный лист журнала</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control" id="thumbnail" type="file" name="submission_thumbnail" accept="image/x-png,image/gif,image/jpeg">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2 my-auto">
                                            <label for="preview"><strong>Фрагмент / Превью</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control" id="preview" type="file" name="submission_preview" accept="application/pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button CLASS="btn btn-dark" type="submit">Загрузить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
