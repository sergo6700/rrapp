<article class="articles-card articles-card_small">
	<img class="articles-card__image" src="{{ asset($item->picture->path ?? '') }}">
	<div class="articles-card__gradient articles-card__gradient_main-page"></div>
	<div class="articles-card__content">
		<span class="articles-card__info-data text text_20 text_white">{{ $item->date->isoFormat('D MMMM, YYYY') ?? '' }}</span>
		<a class="link text_28 text_semi-bold text_white articles-card__info-title">{{ \Str::limit($item->title, 80)  }}</a>
		<div class="section-link-arrow">
			<a class="section-link text_solid link_underline-hover text_solid text_23 text_beige" href="{{ route('article.show', ['slug' => $item->slug ?? null]) }}">
				Читать
			</a>
			<svg class="arrow-icon" width="20" height="14" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0.624997 8.70833L17.7471 8.70834L13.4212 13.0463L15.125 14.75L22.375 7.5L15.125 0.250006L13.4213 1.95375L17.7471 6.29167L0.624997 6.29167L0.624997 8.70833Z" fill="#C59368"/>
			</svg>
		</div>
	</div>
</article>
