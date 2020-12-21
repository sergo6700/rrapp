@if ($crud->hasAccess('update'))
    <button data-toggle="modal"
            data-target='#viewUser'
            data-id="{{ $entry->getKey() }}"
            data-name="{{ $entry->name }}"
            class="btn btn-xs btn-default">
        <i class="fa fa-eye"></i> Просмотреть
    </button>
@endif