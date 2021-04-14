@extends('layouts.app')


@section('content')
    <div class="auto-container">

        <div class="row">
            <div class="col-12 sec-title">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>Список журналов <span>ScienceWeb</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="service-block style-two">
                    <div class="inner-box">
                        <h4>Категории</h4>
                        <div class="input-group">
                            <ul>
                                @foreach($categories as $category)
                                    @php($details = $category->localizedDetails())
                                    <li><label><input type="checkbox" name="category[{{ $category->id }}]">{{ $details->name }}</label></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
                @foreach($journalsCollection as $journals)
                    @foreach($journals as $journal)
                        @php($locSettings = $journal->locSettings('ru_RU', $journal->settings))
                        <div class="result mt-2">
                            <h6>
                                <a class="grey-text text-darken-4"
                                   href="{{ url('https://' . $journal->path . '.' .$journal->database) }}"
                                >{{ $locSettings['name'] }}</a> -
                                <b>{{ $locSettings['publisherInstitution'] }}</b>
                            </h6>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
