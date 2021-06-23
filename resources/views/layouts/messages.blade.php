@if(session('messages'))
    <div class="auto-container">
        <div class="row">
            <div class="col-sm-12">
                @foreach(session('messages') as $msg)
                <div class="alert alert-{{ $msg['status'] }} alert-dismissible fade show" role="alert">
                    {!! $msg['message'] !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
