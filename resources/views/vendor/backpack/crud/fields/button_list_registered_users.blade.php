@if(!empty($entry))
	@php
		/** @var App\Models\Event\Event $entry */
		$event_id = $entry->getKey();
		$countRegisteredMember = $entry->registrations->count();

		$wordMember = number2word($countRegisteredMember, array('участник', 'участника', 'участников'));
		$wordRegistered = number2word($countRegisteredMember, array('Зарегистрировался', 'Зарегистрировалось', 'Зарегистрировалось'));
	@endphp

	<div class="form-group col-xs-12">
		<a title="Список зарегистрированных участников" href="{{ backpack_url() }}/events/{{ $event_id }}/users" target="_blank" class="btn btn-primary">
			{{ $wordRegistered . ' ' . $countRegisteredMember . ' ' . $wordMember }}
		</a>
	</div>
@endif
