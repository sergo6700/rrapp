<article class="articles-card articles-card_big" style="background-image: url('{{ asset($item->picture->path ?? '') }}')">
	<div class="articles-card__info">
		<div class="articles-card__info-content">
			<span class="articles-card__info-data text text_20 text_white">{{ $item ? $item->date->isoFormat('D MMMM, YYYY') : '' }}</span>
			<h3 class="h3 text_white articles-card__info-title articles-card__info-title_big">{{ $item->title ?? ''}}</h3>
			<a class="text text_solid text_20 text_white articles-card__info-link link_underline-hover"
			   href="{{ route('article.show', ['slug' => $item->slug ?? null]) }}">Читать</a>
		</div>
	</div>
</article>
