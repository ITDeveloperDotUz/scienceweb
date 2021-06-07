@extends('layouts.app')

@section('content')
    <div class="auto-container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    @include('profile.publisher_menu')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Tokens</h3>
                        </div>
                        <div class="card-body consult-form">
                            <div class="row">
                                <div class="col-4">
                                    @if(auth()->user()->tokens)
                                        <button id="refreshToken" class="btn btn-success" type="submit">Refresh API token</button>
                                    @else
                                        <button id="refreshToken" class="btn btn-success" type="submit">Create API token</button>
                                    @endif
                                </div>
                                <div class="col-8 my-auto">
                                    <strong id="token"></strong>
                                </div>
                            </div>
{{--                            <form action="{{ route('publisher.settings') }}" method="post">--}}
{{--                                @csrf--}}

{{--                                @if(auth()->user()->tokens)--}}
{{--                                    @foreach(auth()->user()->tokens as $token)--}}
{{--                                        <div class="row my-2">--}}
{{--                                            <div class="col-4 my-auto">--}}
{{--                                                <label for="token"><b>Token</b></label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-8">--}}
{{--                                                <textarea disabled id="token" type="text" rows="20">--}}
{{--                                                    {{ $token->plainTextToken }}--}}
{{--                                                </textarea>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#refreshToken').click(function(){
            $.ajax({
                url: '{{ route('publisher.create_api_token') }}',
                success: function(result){
                    console.log(result)
                    $('#token').text('Your access token: ' + result['token'])
                }
            })
        })
    </script>
@endsection
