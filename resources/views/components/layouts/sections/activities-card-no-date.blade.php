<div class="activity-card activity-card_no-date" itemscope itemtype="http://schema.org/Event">
	<div class="activity-card__content">
		<div class="activity-card__description">
			<h4 class="h4 activity-card__description-title">
				<a href="{{ route('event.show', ['slug' => $event->slug]) }}">
					<span itemprop="name">{{ $event->title }}</span>
				</a>
			</h4>
			<p class="text text_17 text_black-3" itemprop="description">{{ $event->short_content }}</p>
			<meta itemprop="image" content="{{ url('/img/icons/logo-dark-icon.svg') }}">
			<meta itemprop="startDate" content="{{ $event->date_from->format('Y-m-d') }}">
		</div>
		<div class="activity-card__contacts">
			<div class="activity-card__contacts-element" itemprop="location" itemscope itemtype="http://schema.org/Place">
				<div class="title-with-icon">
				  <svg class="activity-card__link-icon" width="15" height="21" viewBox="0 0 15 21" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M7.49967 0.0830078C3.46842 0.0830078 0.208008 3.34342 0.208008 7.37467C0.208008 12.8434 7.49967 20.9163 7.49967 20.9163C7.49967 20.9163 14.7913 12.8434 14.7913 7.37467C14.7913 3.34342 11.5309 0.0830078 7.49967 0.0830078ZM7.49967 9.97884C6.06217 9.97884 4.89551 8.81217 4.89551 7.37467C4.89551 5.93717 6.06217 4.77051 7.49967 4.77051C8.93717 4.77051 10.1038 5.93717 10.1038 7.37467C10.1038 8.81217 8.93717 9.97884 7.49967 9.97884Z" fill="black"/>
				  </svg>
				  <span class="text text_17 text_bold activity-card__contacts-title">Адрес:</span>
				 </div>
				<a class="link" href="{{ route('event.show', ['slug' => $event->slug]) }}#map">
					<meta itemprop="name" content="{{ $event->address->title ?? null }}">
					<span itemprop="address" class="text text_17 text_black-3 activity-card__adress-text">{{ $event->address->title ?? null }}</span>
				</a>

				<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates" class="hidden">
					<meta itemprop="latitude" content="{{ $event->address->latitude ?? null }}" />
					<meta itemprop="longitude" content="{{ $event->address->longitude ?? null }}" />
				</div>
			</div>

			<div class="activity-card__contacts-element" itemprop="performer" itemscope itemtype="http://schema.org/Person">
				<div class="title-with-icon">
				  <svg class="activity-card__link-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M10 10C12.7625 10 15 7.7625 15 5C15 2.2375 12.7625 0 10 0C7.2375 0 5 2.2375 5 5C5 7.7625 7.2375 10 10 10ZM10 12.5C6.6625 12.5 0 14.175 0 17.5V20H20V17.5C20 14.175 13.3375 12.5 10 12.5Z" fill="black"/>
				  </svg>
				  <span class="text text_17 text_bold activity-card__contacts-title">Организатор:</span>
				</div>
				<a class="link" href="{{ route('department.show', $event->division->only('slug')) }}">
					<span itemprop="name" class="text text_17 text_black-3 activity-card__organizer-text">{{ $event->division->name }}</span>
				</a>
			</div>
		</div>

		@if ($cancel_button ?? null)
			<form action="{{ route('registration.event.cancel', ['event' => $event->id ?? null]) }}" method="POST">
				@csrf
				@method('DELETE')
				<button class="button button_rounded button_small button_grey-border-tr button_cancel-activity">
					<span class="text text_17 text_bold text_PT-font text_black">Отменить регистрацию</span>
				</button>
			</form>
		@endif

	</div>
</div>
