<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Laravel Boilerplate (Current: Laravel 6.*)


Шаблон содержит :
 - авторизацию, регистрацию и т.д. (bootstrap)
 - распределение по ролям (admin, author, user)
 - включение,выключение Google Two Factor Authentication


 (дополнительно)
  - по адресу (/admin/translations) добавлен crud для статических переводов



### Установка
1. Скопировать .env.example и настроить окружение
```
mv .env.example .env
```

2. Запустить composer и установить все зависимости
```
composer install
```

3. Сгенерировать application encryption key
```
php artisan key:generate
```

4. Установить зависимости для npm
```
npm install
```

5. Запустить миграции и заполнить базу демо-данными
```
php artisan migrate --seed
```


### Demo Credentials

**Admin:** admin@admin.com  
**Password:** password

**Author:** author@author.com  
**Password:** password

**User:** user@user.com  
**Password:** password
