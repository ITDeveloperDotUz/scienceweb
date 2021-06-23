

<div class="card mt-3">
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <a href="{{ route('profile.edit') }}">Настроить профиль</a>
        </li>
        @can('create submission')
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <a href="{{ route('submission.create') }}">Добавить материал</a>
        </li>
        @endcan
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <span class="text-secondary">Список соавторов</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <span class="text-secondary">Мои материалы</span>
        </li>
{{--        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">--}}
{{--            <span class="text-secondary">Favorites</span>--}}
{{--        </li>--}}
    </ul>
</div>

