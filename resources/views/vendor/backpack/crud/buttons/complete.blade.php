@if ($crud->hasAccess('update'))
	@if (!$entry->is_completed)

	<!-- Single edit button -->
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/complete') }}" class="btn btn-xs btn-default"><i class="fa fa-check"></i> Завершить работу по заявке</a>

	@else

		<a href="{{ url($crud->route.'/'.$entry->getKey().'/return_to_work') }}" class="btn btn-xs btn-default"><i class="fa fa-undo"></i> Вернуть в работу заявку</a>

	@endif
@endif