<div class="time-line swiper-container">
	<ol class="time-line__list swiper-wrapper">
		@foreach ($events_grouped_by_date as $groupedDate => $groupedItems)
		<li class="time-line__list-item swiper-slide">
			<div class="calendar-date {{array_key_first($events_grouped_by_date) == $groupedDate ? 'calendar-date_active' : ''}}">
				<span class="calendar-date__number text text_44 text_red-1 text_semi-bold">{{Date::parse($groupedDate)->format('d')}}</span>
				<span class="calendar-date__week-day text text_28 text_red-1 text_semi-bold">{{mb_strtolower(\App\Support\Date\DateUtils::getCaseOfMonthByNumber(Date::parse($groupedDate)->format('m')))}}, {{mb_strtolower(\App\Support\Date\DateUtils::getShortDayOfWeek(Date::parse($groupedDate)->format('l')))}}</span>
			</div>
			<div class="day-content">
				<div class="day-content__row">
					@foreach ($groupedItems as $item)
						@include('components.layouts.includes.calendar-card')
					@endforeach
				</div>
			</div>
		</li>
		@endforeach
	</ol>
</div>
