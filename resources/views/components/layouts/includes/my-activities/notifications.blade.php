<div class="swiper-slide notofications-slide">

	<form class="notifications-form" action="{{ route('profile.notifications.update', ['tab' => 2]) }}" method="post">
		@method('PATCH')
		@csrf
		<div class="checkboxes-container checkboxes-container_notifications">

			@foreach ($notification_types as $key => $type)
				<label for="type-{{ $type['id'] }}" class="checkbox-label">
					<input
						class="checkbox-input"
						value="{{ $type['id'] }}"
						type="checkbox"
						name="notifications[{{$key}}][type_id]"
						id="type-{{ $type['id'] }}"
						{{ $user->notifications->pluck('type_id')->contains($type['id']) ? 'checked' : '' }}
					>{{ $type['name'] }}
				</label>
			@endforeach

			@foreach($errors->all() as $error)
				<label class="popup-select-error popup-error-show" for="tin">{{ $error }}</label>
			@endforeach

		</div>
		<button type="submit" class="button button_rounded button_big button_brown button_save-notifications">
			<span class="text text_23 text_white text_PT-font">Сохранить</span>
		</button>
	</form>
</div>
