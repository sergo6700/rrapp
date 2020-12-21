<article class="services-card card-hover">
	<div class="services-card__content">
		<h4 class="h4 text_brown-1 services-card__title">{{ $item->title ?? '' }}</h4>
		<p class="text text_17 services-card__text">
			{{ $item->short_content ?? '' }}
		</p>

		<a href="{{ route('service.show', ['slug' => $item->slug ?? null]) }}"
		   class="button button_small button_white button_rounded button_grey-border text_no-underline">
			<span class="text text_semi-bold text_17">Подробнее</span>
		</a>
	</div>
</article>
