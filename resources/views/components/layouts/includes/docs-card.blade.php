@if($documents)
<div class="swiper-slide">
	<div class="docs-card">
		<ul class="docs-card__list">

			@foreach ($documents ?? [] as $item)

				<li class="docs-card__list-item">
					<div class="docs-card__content">
						<div class="docs-card__document-info">
							<a class="docs-card__document-link text_brown-2 text_20 text_solid text_no-underline"
							   href="{{ route('docs.show', ['slug' => $item->slug ?? null]) }}">{{ $item->name ?? '' }}</a>
						</div>
					</div>
				</li>

			@endforeach

		</ul>
		<a href="{{ route('docs.index') }}"
		   class="button button_small button_white button_rounded button_grey-border docs-card__show-button text_no-underline">
			<span class="text text_semi-bold text_17">Увидеть все документы</span>
		</a>
	</div>
</div>
@endif
