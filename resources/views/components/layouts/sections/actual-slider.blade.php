@if($slides->isNotEmpty() && $slides->count() >= 3)
	<section class="actual-section" id="actual">
		<div class="container container_small">
			<h2 class="h2 section-title">Актуальное</h2>
		</div>

		<div class="container container_small actual-slider-container">
			<div class="actual-slider-wrapper">
				<div class="actual-slider">
					<ul class="swiper-wrapper">
						@foreach ($slides as $slide)
							<li class="swiper-slide">
								<a href="{{ $slide->link }}" class="actual-slider__link">
									<picture>
										<source srcset="{{ asset(encode_basename($slide->picture_mobile->path)) }}" media="(max-width: 1024px)">
										<img src="{{ asset(encode_basename($slide->picture_desktop->path)) }}" alt="">
									</picture>
								</a>
							</li>
						@endforeach
					</ul>

					<button class="actual-slider__btn actual-slider__btn--prev" type="button">Предыдущий</button>
					<button class="actual-slider__btn actual-slider__btn--next" type="button">Следующий</button>

					<div class="actual-slider__pagination"></div>
				</div>
			</div>
		</div>
	</section>

	@push('scripts')
		<script>
			(() => {
			var actualSwiper = new Swiper('.actual-slider', {
				loop: true,
				speed: 600,
				slidesPerView: checkDesctop() ? 1 : 'auto',
				spaceBetween: 30,
				loopAdditionalSlides: 3,
				allowTouchMove: !checkDesctop(),
				pagination: {
					el: '.actual-slider__pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.actual-slider__btn--next',
					prevEl: '.actual-slider__btn--prev',
				},
			});

				function checkDesctop() {
					return window.innerWidth > 1024; // $max-laptop in _variables.sass
				}
			})();
		</script>
	@endpush
@endif
