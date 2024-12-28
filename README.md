## CRUD Users
### Получение всех пользователей
- GET http://127.0.0.1:8000/api/users/
![alt text](readme-Image/image.png)
### Получение пользователя по id
- Get http://127.0.0.1:8000/api/users/{id}
![alt text](readme-image/image-1.png)

### Создать нового пользователя
- POST http://127.0.0.1:8000/api/users
- Тело запроса:
 ```
{
    "name": "",
    "email": ""
}
 ```
![alt text](readme-image/image-2.png)
### Обновить пользователя
- PUT http://127.0.0.1:8000/api/users/{id}
- Тело запроса:
 ```
{
    "name": "",
    "email": "",
    "active": true/false(1/0)
}
 ```
![alt text](readme-image/image-3.png)
### Удалить пользователя
- DELETE http://127.0.0.1:8000/api/users/{id}
![alt text](readme-image/image-4.png)

## CRUD Groups
### Создать новую группу
- POST http://127.0.0.1:8000/api/groups
- Тело запроса:
 ```
{
    "name": "Группа13",
    "expire_hours": 1
}
 ```
![alt text](readme-image/image-5.png)
### Обновить группу
- PUT http://127.0.0.1:8000/api/groups/{id}
![alt text](readme-image/image-6.png)

### Получить группу по ID
- GET http://127.0.0.1:8000/api/groups/{id}
![alt text](readme-image/image-7.png)

### Получить все группы
- GET http://127.0.0.1:8000/api/groups
![alt text](readme-image/image-8.png)

## Добавление пользователя в группу
- POST http://127.0.0.1:8000/api/users/{id}/add-to-group
- (Время указывается МСК + кол-во часов группы)
- Тело запроса:
 ```
{
    "group_id": {id}
}
 ```
![alt text](readme-image/image-9.png)

## Добавление через консоль
![alt text](readme-image/image-10.png)
![alt text](readme-image/image-11.png)

## Удаление через консоль
(если не ошибаюсь gmail почты не работают)

![alt text](readme-image/image-12.png)
![alt text](readme-image/image-13.png)
![alt text](readme-image/image-14.png)

## Выполнение каждые 10 минут
Через php artisan schedule:run, можно запустить это выполнение
