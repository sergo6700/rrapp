<nav class="mobile-menu">
	<button class="button_close-mobile" tabindex="-1">
    <span class="button_close-mobile-line"></span>
    <span class="button_close-mobile-line"></span>
  </button>
	<ul class="mobile-menu__list">
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{route('event')}}">Мероприятия</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{route('news')}}">Новости</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{route('article.index')}}">База знаний</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{route('service')}}">Меры поддержки</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{route('department')}}">Подразделения</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{route('docs.index')}}">Документы</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold"  tabindex="-1" href="{{ route('page.show', ['slug' => constant("App\Enums\StaticPagesEnum::ABOUT_PAGE_SLUG")]) }}">О проекте</a></li>
		<li class="mobile-menu__list-item"><a class="link text_16 text_brown-1 text_semi-bold specialButton-bad-visible" tabindex="-1">Версия для слабовидящих</a></li>
		@auth
			<li class="mobile-menu__list-item"><a tabindex="-1" class="link text_16 text_brown-1 text_semi-bold" href="{{ url('/profile') }}">Личный кабинет</a></li>
		@endauth
	</ul>
	@guest
		<button tabindex="-1" class="button_mobile button_brown button-show-popup-enter"><span class="text text_12 text_white text_PT-font text_bold">Войти в личный кабинет</span></button>
	@endguest
	@auth
		<form action="{{ route('logout') }}" method="post">
			@csrf
			<button tabindex="-1" class="button_mobile button_brown"><span class="text text_12 text_white text_PT-font text_bold">Выйти из личного кабинета</span></button>
		</form>
	@endauth
</nav>
