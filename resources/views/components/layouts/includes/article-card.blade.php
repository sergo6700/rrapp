<article class="articles-card articles-card_small articles-card_article-page" style="background-image: url('{{ asset($item->picture->path ?? '') }}')">
	<div class="articles-card__gradient"></div>
	<div class="articles-card__content">
		<span class="articles-card__info-data text text_20 text_white">{{ isset($item) ? $item->date->isoFormat('D MMMM, YYYY') : null }}</span>
		<a class="link text_28 text_semi-bold text_white articles-card__info-title">{{ $item->title ?? null }}</a>
		<div class="section-link-arrow">
			<a class="section-link text_solid link_underline-hover text_solid text_23 text_beige"
			   href="{{ route($show_similar_route ?? '', $item->only('slug') ?? []) }}">
				Читать
			</a>
			<svg class="arrow-icon" width="20" height="14" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0.624997 8.70833L17.7471 8.70834L13.4212 13.0463L15.125 14.75L22.375 7.5L15.125 0.250006L13.4213 1.95375L17.7471 6.29167L0.624997 6.29167L0.624997 8.70833Z" fill="#C59368"/>
			</svg>
		</div>
	</div>
</article>
