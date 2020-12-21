<article class="day-content-card">
	<div class="day-content-card__content">
		<p class="day-content-card__title text text_20 text_brown-1 text_semi-bold">
			<a href="{{ route('event.show', ['slug' => $item['slug']]) }}" class="text_no-underline">{{$item['title']}}</a>
		</p>
			<div class="day-content-card__description">
				<div class="day-content-card__description-element">
					<span class="day-content-card__small-title text text_solid text_brown text_14m">Адрес:</span>
					<p class="day-content-card__adress-text text text_brown-2 text_14m">{{$item['address']['title']}}</p>
				</div>
				<div class="day-content-card__description-element">
					<span class="day-content-card__small-title text text_solid text_brown text_14m">Организатор:</span>
					<p class="day-content-card__organizer-text text text_brown-2 text_14m">{{$item['division']['name']}}</p>
				</div>
			</div>
	</div>
</article>