<header class="header header_active" itemscope itemtype="https://schema.org/Organization">
	<a href="/" class="header-logo" itemprop="url"></a>
	<meta itemprop="logo" content="{{ url('/img/icons/logo-dark-icon.svg') }}">
	<nav class="header-nav">
		<a class="link text text_17 text_white text_semi-bold">Новости</a>
		<a class="link text text_17 text_white text_semi-bold">Статьи</a>
		<a class="link text text_17 text_white text_semi-bold">Меры поддержки</a>
		<a class="link text text_17 text_white text_semi-bold">Подразделения</a>
		<a class="link text text_17 text_white text_semi-bold">Документы</a>
		<a class="link text text_17 text_white text_semi-bold">О проекте</a>
	</nav>
	<div class="header-buttons-container">
		<div class="lk-button-container">
			<button class="button lk-button header-visible-button button_visible-icon">
				<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.5 12.5C15.7229 12.5 18.3333 9.88962 18.3333 6.66671C18.3333 3.44379 15.7229 0.833374 12.5 0.833374C9.27706 0.833374 6.66665 3.44379 6.66665 6.66671C6.66665 9.88962 9.27706 12.5 12.5 12.5ZM12.5 15.4167C8.60623 15.4167 0.833313 17.3709 0.833313 21.25V24.1667H24.1666V21.25C24.1666 17.3709 16.3937 15.4167 12.5 15.4167Z" fill="currentColor"/>
				</svg>
			</button>
			<ul class="header-dropdown">
				<li class="header-dropdown__item">
					<a class="link text_white text_19 text_PT-font header-dropdown__link" href="{{ url('/profile') }}">Личный кабинет</a>
				</li>
				<li class="header-dropdown__item">
					<a class="link text_white text_19 text_PT-font header-dropdown__link" href="#">Выйти</a>
				</li>
			</ul>
		</div>
		<button class="button button_login button_rounded button_small button_white"><span class="text text_bold text_17 text_black">Войти</span></button>

		<button class="button hamburger" tabindex="-1">
			<svg width="20" height="12" xmlns="http://www.w3.org/2000/svg" stroke="null" style="vector-effect: non-scaling-stroke;">
				<g stroke="null">
					<polygon stroke="null" fill="#562212" points="0.021085629239678383,4.933601379394531 19.992584228515625,4.933601379394531 19.992584228515625,6.996880531311035 0.021085629239678383,6.996880531311035 " id="Fill-20" class="st0"/>
					<polygon stroke="null" stroke-width="0" fill="#562212" points="-0.024805204942822456,9.856045722961426 20.00975954988346,9.856045722961426 20.00975954988346,12.011588096618652 -0.024805204942822456,12.011588096618652 " id="Fill-21" class="st0"/>
					<polygon stroke="null" fill="#562212" points="-0.02050911635160446,-0.021008262410759926 19.998578988307287,-0.021008262410759926 19.998578988307287,1.8399395942687988 -0.02050911635160446,1.8399395942687988 " id="Fill-19" class="st0"/>
				</g>
			</svg>
		</button>
		<ul class="header-dropdown">
			<li><a href="#">Личный кабинет</a></li>
			<li><a href="#">Выйти</a></li>
		</ul>
	</div>
</header>
