{{--
Параметры: $mediaItem
--}}
<a href="{{$mediaItem->link}}" target="_blank" class="card-media">
	<div class="card-media__rated-parent">
		<div class="card-media__rated-child">
			<img class="card-media__img" src="{{$mediaItem->picture->path}}">
		</div>
	</div>

	<p
		class="card-media__text text text_brown text_bold"
	>
		{{$mediaItem->description}}
	</p>
</a>
