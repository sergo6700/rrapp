<article class="brief-card">
	<div class="brief-card__line">
		<span class="brief-card__line-title text text_28 text_semi-bold">Дата:</span>
		<span class="brief-card__line-text text text_24">{{ $event->date_from->locale('ru')->isoFormat('D MMMM, dddd') }}</span>
		<meta itemprop="startDate" content="{{ $event->date_from->format('Y-m-d') }}">
	</div>
	<div class="brief-card__line">
		<span class="brief-card__line-title text text_28 text_semi-bold">Время:</span>
		<span class="brief-card__line-text text text_24">{{ $event->date_from->format('H:i') }}{{ $event->date_to ? '-' . $event->date_to->format('H:i') : '' }}</span>
	</div>
	<div class="brief-card__line" itemprop="location" itemscope itemtype="http://schema.org/Place">
		<span class="brief-card__line-title text text_28 text_semi-bold">Адрес:</span>
		<span class="brief-card__line-text text text_24" itemprop="address">{{ $event->address->title ?? null }}</span>
		<meta itemprop="name" content="{{ $event->address->title ?? null }}">

		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates" class="hidden">
			<meta itemprop="latitude" content="{{ $event->address->latitude ?? null }}" />
			<meta itemprop="longitude" content="{{ $event->address->longitude ?? null }}" />
		</div>

	</div>
	<div class="brief-card__line" itemprop="performer" itemscope itemtype="http://schema.org/Person">
		<span class="brief-card__line-title text text_28 text_semi-bold">Организатор:</span>
		<span class="brief-card__line-text text text_24" itemprop="name">{{ $event->division->name ?? null }}</span>
	</div>
</article>
