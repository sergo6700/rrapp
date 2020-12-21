<div class="section-tags section-tags_height {{ $small ?? false ? 'section-tags_small' : '' }}" data-open="false">
	<div class="section-tags__container">
		<ul class="section-tags__list">

			@foreach($tags ?? [] as $item)
				<li class="block-tag">
					<a href="{{ route('service', ['tags' => [$item->name]]) }}" id="js-tag-item" class="block-tag__link link">
						{{ $item->name }}
						<span class="block-tag__count">{{ $item->services_count }}</span>
					</a>

				</li>
			@endforeach

		</ul>
		<button class="button section-tags__button button_mobile button_small button_rounded button_grey-border">Показать еще</button>
	</div>
</div>