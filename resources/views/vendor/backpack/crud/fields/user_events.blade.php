<div @include('crud::inc.field_wrapper_attributes') >

	<ul>
	@if (key_exists('value', $field))
		@foreach ($field['value'] as $event)
			<li>
				<a href="{{ route('crud.upcoming-events.edit', ['upcoming_event' => $event->id]) }}">
					<span>{{ $event->title }}</span>
				</a>
			</li>
		@endforeach
	@endif
	</ul>
</div>