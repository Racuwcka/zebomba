# Тестовое задание

Задача: Реализация авторизации и регистрации в приложении
(Реализации API серверного приложения)

### Доступный пример файла для работы с классом

<b>Имя запроса авторизации и регистрации:</b> user_auth<br>
<b>Метод запроса:</b> GET<br>
<b>Входящие данные:</b> access_token, id, first_name, last_name, country, city, sig<br>
<b>Таблица для хранения данных:</b><br>
users, поля id (int) – идентификатор пользователя, first_name (string) – Имя пользователя, last_name (string) – фамилия, city (string) – Город, country (string) – Страна.<br>
<b>Таблица для хранения сессий:</b><br>
users_sessions (user_id (int) – идентификатор пользователя, access_token (string))

<b>Секретный ключ приложения:</b> 977fea8deca4c2c2330544cf2e388284 (прописан свойством в Модели UserSessions)


### Алгоритм проверки подписи:
1. Сортировка входящих параметров по ключу (используйте ksort)
2. Сформируйте строку $str из полученных параметров исключив из нее sig
3. К концу полученной строки добавьте секретный ключ
4. С полученной строкой выполните mb_strtolower( md5($str), 'UTF-8' ) и сравните результат с пришедшем sig
5. Если mb_strtolower( md5($str), 'UTF-8' ) === sig, зарегистрируйте пользователя, в противном случаи выдайте ошибку

### Развертывание приложения

#### Для запуска Приложения необходимо:
- Переименовать файл .env.example в .env и прописать свои данные БД
- Запустить миграции
```bash
php artisan migrate
```
- Поднять docker-контейнер
```bash
docker-compose up --build -d
```
