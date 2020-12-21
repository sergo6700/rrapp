<?php $tags = [];
foreach ($item->tags ?? [] as $tag) {
	$tags[]=$tag->name;
}
$tags = implode(',',$tags);
?>

@if(isset($item))
<article class="services-card card-hover js-services-card" data-tag="{{$tags}}">
	<div class="services-card__content">
		<h4 class="services-card__title h4 text_brown-1">
			<a href="{{ route('service.show', ['slug' => $item->slug ?? null]) }}" class="text_no-underline">
				{{ $item->title ?? '' }}
			</a>
		</h4>
		<p class="services-card__text text text_17">
			{{ str_limit_to_nearest_character($item->short_content, 300) }}
		</p>

		<div class="hashtag-block">
			<div class="hashtag-block__visible">
				<div class="hashtag-block__inner show_all">

					@foreach ($item->tags ?? [] as $tag)
						<a href="{{route('service', ['tags' => [$tag->name]])}}" class="hashtag-block__tag text text_14m text_black-3">#{{ $tag->name }}</a>
					@endforeach

				</div>
			</div>
			<a href="#" class="hashtag-block__link link link_underline text_black-3 collapse-content">
				<span class="hashtag-block__text text text_14m text_black-3">Показать все</span>
			</a>
		</div>

		<a href="{{ route('service.show', ['slug' => $item->slug ?? null]) }}"
		   class="button button_small button_white button_rounded button_grey-border text_no-underline">
			<span class="text text_semi-bold text_17">Подробнее</span>
		</a>
	</div>

</article>
@endif