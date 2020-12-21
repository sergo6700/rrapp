<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


### URL к локальному хосту
[http://localhost:31080](http://localhost:31080)

###### URL к production-версии сайта
[mbrostov.ru](https://mbrostov.ru)

###### URL к develop-версии сайта
[dev.mbrostov.ru](http://dev.mbrostov.ru)

---
### Как поднять проект

#### Начало работы
На локальный компьютер должны быть установлены:
* docker-compose
* git

Скачиваем проект из Github.com на свой локальный компьютер:
```
git clone git@github.com:odarchenkob/rrapp.git
```

Переходим в корень проекта и выполняем команду:
```
sudo docker-compose up
```

Убедитесь, что все контейнеры успешно поднялись и есть соединение с БД - это можно сделать с помощью команды:
```
sudo docker ps
``` 

Создайте `.env` файл из `.env.local`


После чего заходим в контейнер с PHP с помощью команды 
```
sudo docker-compose exec php-fpm bash
```

и изнутри контейнера накатываем миграции на БД 
```
php artisan migrate
```

Для корректной работы файлового менеджера необходимо сделать символьную ссылку на папку `storage`:
```
php artisan storage:link
```

---
### Админ.панель

Также проект имеет админ.панель, которая находится по адресу 
[localhost:31080/admin](http://localhost:31080/admin)

Для построения админ.панели используется пакет [Laravel Backpack](https://github.com/Laravel-Backpack).

Базовый пакет [Laravel Backpack](https://github.com/Laravel-Backpack) предлагает аутентификацию администратора и пустую панель администратора с использованием AdminLTE.

---
### Настройка SMTP

Для локальной работы на проекте используется сервис
[mailtrap.io](https://mailtrap.io)

Зарегистрируемся в mailtrap (можно также через Github.com)
* после регистрации mailtrap выдаст конфиги для настройки SMTP
* копируем эти настройки в наш `.env` файл

---
### Регистрация нового пользователя
Для регистрации нового пользователя (не для админ.панели!!!) проходим регистрацию на нашем сайте, после чего можно будет попасть в ЛК пользователя
[localhost:31080/profile](http://localhost:31080/profile)

Функции ЛК будут недоступны до тех пор, пока пользователь не подтвердит свой email.

Для подтверждения email'a:
* войдите в свою учетную запись сервиса [mailtrap.io/inboxes](https://mailtrap.io/inboxes)
* найдите письмо с темой `Подтвердите адрес электронной почты` 
* Подтвердите адрес электронной почты

После этого ЛК будет доступен в полном своём функционале!
