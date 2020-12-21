<header class="header">
	<div class="header__content" itemscope itemtype="https://schema.org/Organization">
		<a href="/" class="header-logo" itemprop="url"></a>
		<meta itemprop="logo" content="{{ url('/img/icons/logo-dark-icon.svg') }}">
		<nav class="header-nav" itemscope itemtype="http://www.schema.org/SiteNavigationElement">
			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is('events*')) active @endif"
				href="{{ route('event') }}"
			>Мероприятия</a>

			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is('news*')) active @endif"
			   href="{{ route('news') }}"
			>Новости</a>

			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is('articles*')) active @endif"
			   href="{{ route('article.index')}}"
			>База знаний</a>

			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is('services*')) active @endif"
			   href="{{ route('service') }}"
			>Меры поддержки</a>

			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is('departments*')) active @endif"
			   href="{{ route('department') }}"
			>Подразделения</a>

			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is('docs*')) active @endif"
			   href="{{ route('docs.index') }}"
			>Документы</a>

			<a itemprop="url"
			   class="link text text_17 text_semi-bold @if (Request::is(constant("App\Enums\StaticPagesEnum::ABOUT_PAGE_SLUG"))) active @endif"
			   href="{{ route('page.show', ['slug' => constant("App\Enums\StaticPagesEnum::ABOUT_PAGE_SLUG")]) }}"
			>О проекте</a>
		</nav>
		<div class="header-buttons-container">
			<button class="button header-visible-button button_visible-icon specialButton-bad-visible" aria-label="Перейти на версию для слабовидящих">
				<svg width="33" height="23" viewBox="0 0 33 23" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M16.4997 0.5625C9.20801 0.5625 2.98092 5.09792 0.458008 11.5C2.98092 17.9021 9.20801 22.4375 16.4997 22.4375C23.7913 22.4375 30.0184 17.9021 32.5413 11.5C30.0184 5.09792 23.7913 0.5625 16.4997 0.5625ZM16.4997 18.7917C12.4747 18.7917 9.20801 15.525 9.20801 11.5C9.20801 7.475 12.4747 4.20833 16.4997 4.20833C20.5247 4.20833 23.7913 7.475 23.7913 11.5C23.7913 15.525 20.5247 18.7917 16.4997 18.7917ZM16.4997 7.125C14.0788 7.125 12.1247 9.07917 12.1247 11.5C12.1247 13.9208 14.0788 15.875 16.4997 15.875C18.9205 15.875 20.8747 13.9208 20.8747 11.5C20.8747 9.07917 18.9205 7.125 16.4997 7.125Z" fill="currentColor"/>
				</svg>
			</button>




			<div class="lk-button-container">
				<svg class="header-icon-beta" style="margin-right: 16px;" width="51" height="24" viewBox="0 0 51 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="1" y="1" width="49" height="21" rx="5" stroke="#F0F0F0" stroke-width="2"/>
					<path d="M15.766 14.28C15.766 14.994 15.29 15.368 14.678 15.368C14.1 15.368 13.675 15.062 13.301 14.688L12.672 16.184C13.148 16.728 13.981 17.187 15.154 17.187C16.752 17.187 17.857 15.878 17.857 14.331C17.857 11.679 15.086 11.849 15.086 10.217C15.086 9.027 16.463 8.959 16.463 7.259C16.463 5.967 15.239 4.913 13.573 4.913C11.38 4.913 10.054 5.984 10.054 8.5V17.017H12.009V8.67C12.009 7.344 12.4 6.749 13.284 6.749C13.913 6.749 14.389 7.123 14.389 7.633C14.389 8.636 12.995 8.84 12.995 10.608C12.995 12.529 15.766 12.75 15.766 14.28ZM25.4523 14.858C25.0103 15.215 24.2283 15.555 23.2933 15.555C22.0863 15.555 21.1683 14.926 20.9983 13.77H26.5233C26.6083 13.481 26.6423 13.192 26.6423 12.716C26.6423 10.574 24.9933 9.163 23.0213 9.163C20.5053 9.163 18.9753 10.948 18.9753 13.175C18.9753 15.589 20.6243 17.187 23.0893 17.187C24.1603 17.187 25.2483 16.881 26.0133 16.235L25.4523 14.858ZM22.9363 10.795C24.0583 10.795 24.7043 11.526 24.6873 12.461H20.9303C21.1343 11.458 21.7633 10.795 22.9363 10.795ZM28.0469 14.093C28.0469 16.048 28.6929 17.17 30.4269 17.17C31.4129 17.17 32.2289 16.796 32.6879 16.422L32.0929 14.909C31.8209 15.113 31.4469 15.351 30.9199 15.351C30.2739 15.351 30.0019 14.807 30.0019 13.974V11.186H32.4669V9.35H30.0019V7.225H28.0469V14.093ZM34.9379 11.322C35.4989 11.067 36.0599 10.795 36.9439 10.795C38.0829 10.795 38.4229 11.492 38.3719 12.767C37.9979 12.495 37.3179 12.274 36.6379 12.274C35.0909 12.274 33.8499 13.073 33.8499 14.756C33.8499 16.235 34.8529 17.102 36.2469 17.102C37.2839 17.102 38.0999 16.694 38.5079 16.116V17H40.2079V12.342C40.2079 10.319 39.4089 9.163 37.1479 9.163C36.1449 9.163 35.1079 9.503 34.4449 9.894L34.9379 11.322ZM36.8929 15.453C36.2809 15.453 35.8049 15.13 35.8049 14.552C35.8049 13.906 36.3829 13.6 37.0289 13.6C37.5899 13.6 38.0319 13.719 38.3719 13.974V14.756C38.1339 15.096 37.7089 15.453 36.8929 15.453Z" fill="#F0F0F0"/>
				</svg>

				@auth
				<button class="button lk-button header-visible-button button_visible-icon">
					<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.5 12.5C15.7229 12.5 18.3333 9.88962 18.3333 6.66671C18.3333 3.44379 15.7229 0.833374 12.5 0.833374C9.27706 0.833374 6.66665 3.44379 6.66665 6.66671C6.66665 9.88962 9.27706 12.5 12.5 12.5ZM12.5 15.4167C8.60623 15.4167 0.833313 17.3709 0.833313 21.25V24.1667H24.1666V21.25C24.1666 17.3709 16.3937 15.4167 12.5 15.4167Z" fill="currentColor"/>
					</svg>
				</button>
				<ul class="header-dropdown">
					<li class="header-dropdown__item">
						<a class="link text_19 text_PT-font header-dropdown__link" href="{{ url('/profile') }}">Личный кабинет</a>
					</li>
					<li class="header-dropdown__item">
						{{-- <a class="link text_white text_19 text_PT-font header-dropdown__link" href="#">Выйти</a> --}}
						<form action="{{ route('logout') }}" method="post">
							@csrf
							<button class="link header-dropdown__link"><span class="text text_19 text_PT-font">Выйти</span></button>
						</form>
					</li>
				</ul>
				@endauth
			</div>

			@guest
			<button class="button button_login button_rounded button_small button_white button-show-popup-enter"><span class="text text_bold text_17 text_black text_PT-font">Войти</span></button>
			@endguest

			<button class="button hamburger" tabindex="-1">
				<svg width="20" height="12" xmlns="http://www.w3.org/2000/svg" stroke="null" style="vector-effect: non-scaling-stroke;">
					<g stroke="null">
						<polygon stroke="null" fill="#562212" points="0.021085629239678383,4.933601379394531 19.992584228515625,4.933601379394531 19.992584228515625,6.996880531311035 0.021085629239678383,6.996880531311035 " id="Fill-20" class="st0"/>
						<polygon stroke="null" stroke-width="0" fill="#562212" points="-0.024805204942822456,9.856045722961426 20.00975954988346,9.856045722961426 20.00975954988346,12.011588096618652 -0.024805204942822456,12.011588096618652 " id="Fill-21" class="st0"/>
						<polygon stroke="null" fill="#562212" points="-0.02050911635160446,-0.021008262410759926 19.998578988307287,-0.021008262410759926 19.998578988307287,1.8399395942687988 -0.02050911635160446,1.8399395942687988 " id="Fill-19" class="st0"/>
					</g>
				</svg>
			</button>
		</div>
	</div>
</header>
