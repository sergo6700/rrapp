@php
	$sidePanelItems = [
		[
			'icon' => '/img/icons/fire--white.svg',
			'title' => 'Актуальное',
			'ancor' => '#actual'
		],
		[
			'icon' => '/img/icons/hands--white.svg',
			'title' => 'Меры поддержки',
			'ancor' => '#services'
		],
		[
			'icon' => '/img/icons/calendar--white.svg',
			'title' => 'Мероприятия',
			'ancor' => '#calendar'
		],
		[
			'icon' => '/img/icons/study--white.svg',
			'title' => 'Полезные статьи',
			'ancor' => '#articles'
		]
	];

	$corona = true
@endphp


<svg style="display: none;">
	<symbol id="arrow-down" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
		<g clip-path="url(#clip0)">
			<path
				d="M15.7083 3.62484L15.7083 20.7469L20.0463 16.4211L21.75 18.1248L14.5 25.3748L7.25001 18.1248L8.95375 16.4211L13.2917 20.7469L13.2917 3.62484L15.7083 3.62484Z"
				fill="white" />
		</g>
		<defs>
			<clipPath id="clip0">
				<rect width="29" height="29" transform="matrix(-4.37114e-08 -1 -1 7.24982e-08 29 29)" fill="white" />
			</clipPath>
		</defs>
	</symbol>
</svg>

<aside class="side-panel">
	<nav class="side-panel__nav side-panel__nav--hidden">
		@if($corona)
			<div class="side-panel__item side-panel__item--red
				@if(empty($is_red_panel_closed)) side-panel__item--active @endif
			">
				<div class="side-panel__decor-icon-wrapper">
					<img class="side-panel__decor-icon" src="/img/icons/attention--white.svg" alt="">
				</div>

				<a href="/news/127-antikrizisnye-mery-podderzhki-donskogo-biznesa"
					class="side-panel__link link text_white">
					Антикризисные меры поддержки
					<svg class="side-panel__arrow-icon side-panel__arrow-icon--to-right" width="29" height="29">
						<use xlink:href="#arrow-down"></use>
					</svg>
				</a>

				<button class="side-panel__btn side-panel__btn--close">
					Закрыть
				</button>
			</div>
		@endif

		@if(isset($isMainPage))
			<ul class="side-panel__list">
				@foreach ($sidePanelItems as $item)
					<li class="side-panel__item">
						<div class="side-panel__decor-icon-wrapper">
							<img class="side-panel__decor-icon" src={{ $item['icon'] }} alt="">
						</div>

						<a href="{{ $item['ancor'] }}" class="side-panel__link link text_white">
							{{ $item['title'] }}
							<svg class="side-panel__arrow-icon" width="29" height="29">
								<use xlink:href="#arrow-down"></use>
							</svg>
						</a>
					</li>
				@endforeach
			</ul>
		@endif

		<button class="side-panel__btn side-panel__btn--close-menu">
			Закрыть
		</button>
	</nav>

	<button class="side-panel__btn side-panel__btn--menu">
		Открыть меню
		<img class="side-panel__decor-icon" src="/img/icons/attention--white.svg" alt="">
	</button>

	<a href="#UpButton" class="side-panel__btn side-panel__btn--up side-panel__btn--up-hidden" style="pointer-events: none;">
		Наверх
		<svg class="side-panel__arrow-icon side-panel__arrow-icon--to-top"  width="29" height="29">
			<use xlink:href="#arrow-down"></use>
		</svg>
	</a>
</aside>

@push('scripts')
	<script>
		(() => {
			const sidePanel = document.querySelector('.side-panel');
			const sidePanelNav = sidePanel.querySelector('.side-panel__nav');
			const sidePanelAttentionItem = sidePanel.querySelector('.side-panel__item--active');

			const sidePanelCloseBtn = sidePanel.querySelector('.side-panel__btn--close');
			const sidePanelCloseMenuBtn = sidePanel.querySelector('.side-panel__btn--close-menu');
			const sidePanelUpBtn = sidePanel.querySelector('.side-panel__btn--up');
			const sidePanelMenuBtn = sidePanel.querySelector('.side-panel__btn--menu');

			const sidePanelList = sidePanel.querySelector('.side-panel__list')
			const sidePanelLinks = sidePanelList ? Array.from(sidePanelList.querySelectorAll('.side-panel__link')) : [];

			const pageBlocks = sidePanelLinks.map(link => document.querySelector(link.getAttribute('href')))
			const sidePanelLinksSorted = sidePanelLinks.filter((link, i) => pageBlocks[i] !== null)
			const sectionsCoordinates = pageBlocks.filter(block => block !== null).map(block => block.offsetTop);

			const fade = document.querySelector('.fade');

			for (let i = 0; i < sidePanelLinksSorted.length; i++) {
				sidePanelLinksSorted[i].addEventListener('click', (e) => {
					e.preventDefault();
					scrollTo(e, sectionsCoordinates[i]);
				})
			}

			sidePanelLinks.forEach((link, i) => {
				pageBlocks[i] === null && (link.offsetParent.style.display = "none")
			})

			const handleDeviceWidth = (isDesctop => () => {
				if (checkDesctop() !== isDesctop) {
					isDesctop = checkDesctop();
					isDesctop ? handleDesctop() : handleMobile();
				}
			})();

			handleDeviceWidth();

			window.addEventListener('resize', lodashDebounce(() => handleDeviceWidth(), 100));
			observeScrolling();

			sidePanelNav.classList.remove('side-panel__nav--hidden');

			function handleDesctop() {
				sidePanelCloseBtn.addEventListener('click', doCloseBtnUnactive);
				sidePanelMenuBtn.removeEventListener('click', openMenu);
				for (let i = 0; i < sidePanelLinksSorted.length; i++) {
					sidePanelLinksSorted[i].removeEventListener('click', closeMenu)
				}
			}

			function handleMobile() {
				doCloseBtnUnactive();
				sidePanelCloseBtn.removeEventListener('click', doCloseBtnUnactive);
				sidePanelMenuBtn.addEventListener('click', openMenu);
				for (let i = 0; i < sidePanelLinksSorted.length; i++) {
					sidePanelLinksSorted[i].addEventListener('click', closeMenu)
				}
				sidePanelNav.style.top = `calc(50vh - ${sidePanelNav.offsetHeight/2}px)`
			}


			function doCloseBtnUnactive() {
				if (!sidePanelAttentionItem) {
					return
				}

				sidePanelAttentionItem.classList.remove('side-panel__item--active');

				// чтобы плашка успела свернуться, иначе мешает :hover в css
				sidePanelAttentionItem.classList.add('side-panel__item--in-progress');
				setTimeout(function() {
					sidePanelAttentionItem.classList.remove('side-panel__item--in-progress');
				}, 1000);

				sidePanelCloseBtn.removeEventListener('click', doCloseBtnUnactive);

				// установим cookie, чтобы при следующем открытии страницы
				// плашка с "Антикризисными мерами" была в свернутом виде
				setCookie();
			}

			function setCookie() {
				const ONE_DAY = 86400e3;

				let domain = location.hostname;
				let date = new Date(Date.now() + ONE_DAY * 30);
				date = date.toUTCString();
				document.cookie = "is_red_panel_closed=true; path=/; domain=" + domain + "; expires=" + date
			}

			function openMenu() {
				sidePanelNav.classList.add('side-panel__nav--active');
				sidePanelCloseMenuBtn.addEventListener('click', closeMenu)
				addFade()
			}

			function closeMenu() {
				sidePanelNav.classList.remove('side-panel__nav--active');
				sidePanelCloseMenuBtn.removeEventListener('click', closeMenu)
				removeFade()
			}

			function addFade() {
				fade.classList.add('fade-show--over-header');
				fade.addEventListener('click', closeMenu);
				fade.addEventListener('click', removeFade);
			}

			function removeFade() {
				fade.classList.remove('fade-show--over-header');
				fade.removeEventListener('click', closeMenu);
				fade.removeEventListener('click', removeFade);
			}


			function scrollTo(e, top) {
				e.preventDefault();

				let anchor = $(e.target).attr('href');
				if (!anchor && $(e.target).parent('.side-panel__btn--up').length > 0) {
					anchor = $(e.target).parent('.side-panel__btn--up').attr('href')
				}

				if (anchor) {
					anchor = anchor.replace(/#/, '')

					$('html, body').animate({
						scrollTop: $('a[name=' + anchor +']').offset().top - 100
					}, 900);
				}
			}

			function checkDesctop() {
				return window.innerWidth > 835; // $laptop in _variables.sass
			}

			function observeScrolling() {
				const header = document.querySelector('.header');

				const upBtnvisibilityHandler = (mutationsList, observer) => {
					for (let mutation of mutationsList) {
						if (mutation.target.classList.contains('header_active')) {
							sidePanelUpBtn.style.pointerEvents = 'auto'
							sidePanelUpBtn.classList.remove('side-panel__btn--up-hidden');
							sidePanelUpBtn.addEventListener('click', scrollTo);
						} else {
							sidePanelUpBtn.style.pointerEvents = 'none'
							sidePanelUpBtn.classList.add('side-panel__btn--up-hidden')
							sidePanelUpBtn.removeEventListener('click', scrollTo);
						}
					}
				};

				const observer = new MutationObserver(upBtnvisibilityHandler);
				observer.observe(header, { attributes: true });
			}
		})();
	</script>
@endpush
