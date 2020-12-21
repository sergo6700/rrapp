<article class="services-card card-hover department-card">
	<div class="services-card__content test">
		<h4 class="services-card__title h4 text_brown-1">{{ $item->name ?? '' }}</h4>

		<a href="{{ route('department.show', $item->only('slug') ?? []) }}"
		   class="text_beige">
			<span class="text text_semi-bold text_28 text_beige">Подробнее</span>
			<span class="phone-arrow">
				<svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0.330075 8.70833L17.4522 8.70834L13.1263 13.0463L14.8301 14.75L22.0801 7.5L14.8301 0.250006L13.1263 1.95375L17.4522 6.29167L0.330075 6.29167L0.330075 8.70833Z" fill="#C59368"/>
				</svg>
			</span>
		</a>
	</div>
</article>

