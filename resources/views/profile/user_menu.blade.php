<div class="card mt-3">
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <a href="{{ route('profile.edit') }}">Settings</a>
        </li>
        @can('create submission')
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <a href="{{ route('submission.create') }}"><span class="text-secondary">Submit article</span></a>
        </li>
        @endcan
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <span class="text-secondary">Co-authors</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <span class="text-secondary">My submissions</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <span class="text-secondary">Favorites</span>
        </li>
    </ul>
</div>
