@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('css/choosen/chosen.css') }}">
@endsection
@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-12">
                    <div class="consult-form">

                        <form action="{{ route('submission.store') }}" method="post">
                            @method('post')
                            @csrf
                            <input type="hidden" name="locale" value="{{ session()->has('submission_locale')? session()->get('submission_locale'): '' }}">
                            <input type="hidden" name="submission_filename" value="{{ session()->has('submission_filename')? session()->get('submission_filename'): '' }}">
                            <input type="hidden" name="preview_filename" value="{{ session()->has('preview_filename')? session()->get('preview_filename'): '' }}">
                            <input type="hidden" name="thumb_filename" value="{{ session()->has('thumb_filename')? session()->get('thumb_filename'): '' }}">
                            <input type="hidden" name="path" value="{{ session()->has('path')? session()->get('path'): '' }}">

                            <div class="card mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach(config('app.locales') as $locale)
                                            <li class="nav-item" role="presentation">
                                                <button
                                                    class="nav-link {{ session()->get('submission_locale') == $locale ? 'active': '' }}"
                                                    id="lang_{{ $locale }}"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#locale_{{ $locale }}"
                                                    type="button" role="tab"
                                                        aria-controls="locale_{{ $locale }}_tab" {{ session()->get('submission_locale') == $locale ? 'aria-selected="true"': '' }}>
                                                    <img width="20" src="{{ asset('images/icons/flags/'.$locale.'-32.png') }}" alt="">
                                                    {{ __('site.locales.'.$locale) }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content" id="tab_content">
                                        @foreach(config('app.locales') as $locale)
                                        <div class="tab-pane fade show {{ session()->get('submission_locale') == $locale ? 'active': '' }}" id="locale_{{ $locale }}" role="tabpanel" aria-labelledby="locale_{{ $locale }}_tab">
                                            <div class="my-2">
                                                <div class="row">
                                                    <div class="col-md-2 my-auto">
                                                        <label for="{{ $locale }}_title"><strong>Заголовок</strong></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input id="{{ $locale }}_title" type="text" name="locales[{{ $locale }}][title]" value="{{ session()->get('submission_locale') == $locale ? session()->get('submission_filename') : '' }}" {{ session()->get('submission_locale') == $locale ? 'required': '' }}>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 mt-2">
                                                        <label for="{{ $locale }}_abstract"><strong>Аннотация</strong></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea name="locales[{{ $locale }}][abstract]" id="{{ $locale }}_abstract" cols="30" rows="10" {{ session()->get('submission_locale') == $locale ? 'required': '' }}></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 my-auto">
                                                        <label for="{{ $locale }}_keywords"><strong>Ключевые слова</strong></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input id="{{ $locale }}_keywords" data-role="tagsinput" name="locales[{{ $locale }}][keywords]" type="text" {{ session()->get('submission_locale') == $locale ? 'required': '' }}>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 my-auto">
                                                        <label for="{{ $locale }}_publisher"><strong>Издатель</strong></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input id="{{ $locale }}_publisher" name="locales[{{ $locale }}][publisher]" type="text" {{ session()->get('submission_locale') == $locale ? 'required': '' }}>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 my-auto">
                                                        <label for="{{ $locale }}_included"><strong>Включен в базы</strong></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input id="{{ $locale }}_included" name="locales[{{ $locale }}][included]" type="text" {{ session()->get('submission_locale') == $locale ? 'required': '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 my-auto">
                                            <label for="doi"><strong>DOI</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input name="doi" id="doi" type="text" class="">
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-md-2 my-auto">
                                            <label for="coauthors"><strong>Авторы</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="d-inline-block" id="co_authors_list">
                                                <div class="single-author bg-gray-300">{{ $user->first_name }} {{ $user->last_name }}
                                                </div>

                                            </div>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @can('add reference-to-submission')
                                        <div class="row">
                                            <div class="col-md-2 my-auto">
                                                <label for="references"><strong>Библиографические ссылки</strong></label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="references" id="references" cols="30"
                                                          rows="5"></textarea>
                                            </div>
                                        </div>
                                    @endcan
                                    <div class="row">
                                        <div class="col-md-2 my-auto">
                                            <label for="published_at"><strong>Дата публикации</strong></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control" type="date" name="published_at" id="published_at">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 my-auto">
                                            <label for="section_id"><strong>Раздел</strong></label>
                                        </div>
                                        <div class="col-md-10 my-1">
                                            <select name="section_id" id="section_id" class="chosen-select" tabindex="17">
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->localizedDetails()->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 my-auto">
                                            <label for="category_id"><strong>Категория</strong></label>
                                        </div>
                                        <div class="col-md-10 my-1">
                                            <select name="category_id" id="category_id"  class="chosen-select" multiple>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->localizedDetails()->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button CLASS="btn btn-dark" type="submit">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить со-автора</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="author_firstname">Имя</label>
                            <input type="text" class="form-control" id="author_firstname" name="author_firstname">
                        </div>
                        <div class="form-group col-6">
                            <label for="author_lastname">Фмилия</label>
                            <input type="text" class="form-control" id="author_lastname" name="author_lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author_email">email</label>
                        <input type="email" class="form-control" id="author_email" name="author_email">
                    </div>
                    <div class="form-group">
                        <label for="author_orcid">ORCID</label>
                        <input type="text" class="form-control" id="author_orcid" name="author_orcid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="addAuthorButton" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
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

        $('#addAuthorButton').click(function(){
            let name = $('#author_firstname')
            let lastname = $('#author_lastname')
            let email = $('#author_email')
            let orcid = $('#author_orcid')
            let id = Math.random() * 10000000
            let content = '<div class="single-author bg-gray-300">' + name.val() + ' ' + lastname.val() + ' <button type="button" onclick="$(this).parent().remove()" class="fa fa-minus"></button>' +
                '<input type="hidden" name="authors[author_' + id + '][name]" value="'+ name.val() +'">' +
                '<input type="hidden" name="authors[author_' + id + '][lastname]" value="'+ lastname.val() +'">' +
                '<input type="hidden" name="authors[author_' + id + '][email]" value="'+ email.val() +'">' +
                '<input type="hidden" name="authors[author_' + id + '][orcid]" value="'+ orcid.val() +'"></div>'

            name.val('')
            lastname.val('')
            email.val('')
            orcid.val('')
            $('#co_authors_list').append(content)
        })
    </script>
@endsection
