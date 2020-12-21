<div class="title-with-filters">
	<div class="title-with-filters__content">
		<div class="title-with-filters__title">
			<h1 class="h2 text_semi-bold">
				{{($past ?? null) ? 'Прошедшие мероприятия' : 'Будущие мероприятия'}}
			</h1>
		</div>
		<div class="title-with-filters__buttons">

			<form action="{{ route('event') }}" method="GET" class="inconspicuous_form">
				<input type="hidden" name="past" value="{{ ($past ?? null) ? 0 : 1 }}">
				<button class="button button_rounded button_small button_grey-border-tr button_big-filter-button">
					<span class="text text_17 text_bold text_black">{{ ($past ?? null) ? 'Будущие мероприятия' : 'Прошедшие мероприятия' }}</span>
				</button>
			</form>

			<button class="button button_rounded button_grey-border-tr button_filter">
				<svg width="18" height="18" class="svg-filter" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.5833 17.25H15.4167V11.75H13.5833V17.25ZM2.58333 17.25H4.41667V8.08333H2.58333L2.58333 17.25ZM17.25 8.08333H15.4167L15.4167 0.75H13.5833L13.5833 8.08333H11.75V9.91667H17.25V8.08333ZM6.25 13.5833H8.08333V17.25H9.91667V13.5833H11.75V11.75H6.25V13.5833ZM9.91667 0.75H8.08333V9.91667H9.91667L9.91667 0.75ZM6.25 6.25V4.41667H4.41667V0.75H2.58333V4.41667H0.75L0.75 6.25H6.25Z" fill="black"/>
				</svg>
				<span class="text text_bold text_17 text_black">Фильтр</span>
			</button>
		</div>
	</div>

	<form action="{{ route('event') }}" method="GET" class="title-with-filters__form">
		<input type="hidden" name="past" value="{{ ($past ?? null) ? 0 : 1 }}">
		<button class="button button_rounded button_grey-border-tr button_filter-mobile">
			<span class="text text_12 text_bold text_black text_PT-font">{{ ($past ?? null) ? 'Будущие мероприятия' : 'Прошедшие мероприятия' }}</span>
		</button>
	</form>

	@include('components.layouts.includes.filter-dropdown')
</div>
