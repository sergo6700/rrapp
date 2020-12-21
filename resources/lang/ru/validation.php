<?php

return [
	'required' => 'Поле :attribute обязательно для заполнения',
	'string' => '',
	'max' => 'Поле :attribute должно быть меньше :max',
	'min.string' => 'Поле :attribute должно быть больше :min',
	'max.string' => 'Поле :attribute слишком длинное (максимальное количество символов равно :max)',
	'unique' => 'Поле :attribute с таким значением уже существует',
	'email' => 'Поле :attribute должно быть валидным email',
	'confirmed' => 'Поле :attribute должно быть подтверждено',
	'required_with' => 'Поле :attribute обязательно для заполнения',
	'regex' => 'Некорректный формат',
	'required_unless' => 'Поле :attribute обязательно для заполнения',
    'min.numeric' => 'Поле должно быть числовым',

	'attributes' => [
		'title' => 'Заголовок',
		'name' => 'ФИО', // Название
		'email' => 'Почта',
		'password' => 'Пароль',
		'password_confirmation' => 'Подтвердите пароль',
		'content' => 'Контент',
		'role_in_company_id' => 'Роль',
		'tin' => 'ИНН',
		'company_name' => 'Организация',
		'full_name' => 'ФИО',
		'kind_of_activity' => 'Вид деятельности',
		'subject' => 'Тема',
		'slug' => 'Ссылка',
		'phone' => 'Телефон',
	],

	'custom' => [
		'captcha_error' => 'Ошибка проверки captcha',
		'g-recaptcha-response.required' => 'Ошибка проверки captcha',
		'personalData.required' => 'Поле обязательно для заполнения',
		'siteRules.required' => 'Поле обязательно для заполнения',
	],

];
