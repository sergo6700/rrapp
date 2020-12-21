<div class="section-tags section-tags_height {{ $small ?? false ? 'section-tags_small' : '' }}" data-open="false">
	<div class="section-tags__container">
		<ul class="section-tags__list">

			@foreach($tags ?? [] as $tag)
			<li class="block-tag">

				@if($selected_tags && $selected_tags->contains($tag))
					<a href="javascript:void(0)" class="block-tag__link link js-tag-item block-tag__link_active" data-tag="{{ $tag->name }}">
						#{{ $tag->name ?? null }}
						<span class="block-tag__count">{{ $tag->services_count ?? null }}</span>
					</a>
				@else
					<a href="javascript:void(0)" class="block-tag__link link js-tag-item" data-tag="{{ $tag->name }}">
						#{{ $tag->name }}
						<span class="block-tag__count">{{ $tag->services_count }}</span>
					</a>
				@endif

			</li>
			@endforeach

		</ul>
		<button class="button section-tags__button button_mobile button_small button_rounded button_grey-border">Показать еще</button>
	</div>
</div>
