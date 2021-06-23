@extends('layouts.app')
@section('title', 'ТОП-100 авторов Узбекистана по версии Web of Science')

@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="sec-title">
                <h2><span>ТОП-100</span> авторов Узбекистана по версии Web of Science</h2>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered  align-middle">
                        <thead>
                        <tr>
                            <th scope=""></th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Имя автора</th>
                            <th scope="col">Публикации</th>
                            <th scope="col">H-index</th>
                            <th scope="col">Цитирование</th>
                            <th scope="col">СЦ за год</th>
                            <th scope="col">СЦ на публикацию</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($profiles as $profile)
                            <tr>
                                <th scope="row">
                                    #{{ $i }}
                                    @php($i++)
                                </th>
                                <td>
                                    @if($profile->avatar)
                                        <img src="{{ $profile->avatar }}" alt="" width="50" height="50">
                                    @else
                                        <img src="{{ asset('images/icons/no_gender.png') }}" alt="" width="50" height="50">
                                    @endisset
                                </td>
                                <td>
{{--                                    @if($profile->user->orcid)--}}
{{--                                        <a href="/{{ $profile->user->orcid }}">--}}
{{--                                            <h5>{{ $profile->public_name }}</h5>--}}
{{--                                        </a>--}}
{{--                                    @else--}}
                                    <a href="https://publons.com/researcher/{{ $profile->publons_user_id }}">
                                        <h5>{{ $profile->publons_user_name }}</h5>
                                    </a>

{{--                                    @endif--}}
                                    @if($profile->institutions)
                                        {{ json_decode($profile->institutions, true)[0]['name'] }}
                                    @else
                                        <span class="text-danger">Организация в профиле Publons не добавлена</span>
                                    @endif
                                </td>
                                <td><b>{{ $profile->publications_count }}</b></td>
                                <td>
                                    @isset($profile->h_index)
                                        {{ $profile->h_index }}
                                    @else
                                        <i class="fa fa-eye-slash"></i>
                                    @endisset
                                </td>
                                <td>
                                    @isset($profile->citations)
                                        {{ $profile->citations }}
                                    @else
                                        <i class="fa fa-eye-slash"></i>
                                    @endisset
                                </td>
                                <td>
                                    @isset($profile->average_per_year)
                                        {{ $profile->average_per_year }}
                                    @else
                                        <i class="fa fa-eye-slash"></i>
                                    @endisset
                                </td>
                                <td>
                                    @isset($profile->average_per_item)
                                        {{ $profile->average_per_item }}
                                    @else
                                        <i class="fa fa-eye-slash"></i>
                                    @endisset
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
