1. авторизация пользователя:
Postman endpoint:http://localhost:8000/auth/login
body: 
обязательные поля для заполения:
"email":"Test@mail.com",
"password":"12345678"
ответ успешной авторизации:  
"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NjUyNTk4MzEsImV4cCI6MTU2NTI2MzQzMSwibmJmIjoxNTY1MjU5ODMxLCJqdGkiOiJ4WDd4S2lDbVBERHhuY3N1Iiwic3ViIjozNywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.ME9rNU8IJcejzTSB_CipsjL3ucFZygGGZwGHffPFt7w",
"token_type": "bearer",
"expires_in": 3600
ответ при неправило введенных данных:"message": 'error' => 'Unauthorized', статус 404 NOT_FOUND
        
2.посмотреть информацию по авторизированному пользователю:
Postman endpoint:http://localhost:8000/auth/me
ответ при правильно веденном ранее полученого access_token : 
"id": 12,
"name": "Test name",
"email": "test@mail.com",
"email_verified_at": null,
"created_at": "2019-10-10 20:20:15",
"updated_at": "2019-10-10 20:20:15"
ответ при неправильно введенным access_token: 'error' => 'Unauthorized'], статус 404 NOT_FOUND
       
3.Добавление росхода/дохода авторизированного пользователя: 
Postman endpoint: POST http://localhost:8000/api/add
body: 
ответ при валидных данных: статус 201 CREATED
ответ при невалидных данных:
{
    "message": "Invalid data",
} 
    
4. отображение всех данных о расходах/доходах авторизированного пользователя:
Postman endpoint: GET http://localhost:8000/api/show
ответ при валидных данных: выведение данных, статус 200 ОК
        
5. поиск данных о расходах/доходах по заданому типу:
Postman endpoint: GET http://localhost:8000/api/type/{type}
ответ при наличии типа income или outcome:  выведение данных, статус 200 ОК
ответ при отсутствии указаного типа:
{
    "message": 'Error: Invalid type'  
}, статус 404 NOT_FOUND
ответ при отсутствии записей данного типа:
{
    "message": 'Error: not found'
}, статус 400 BAD_REQUEST
            
6. редактирование данных о записи:
Postman endpoint: PUT http://localhost:8000/update
ответ:  выведение измененных данных, статус 200 ОК

7. удаление данных о записи:
Postman endpoint: DELETE http://localhost:8000/delete
ответ при наличии указаного id: 
{
    "message" : 'Record deleted'
}, статус 204 No Content
                
8. получение данных о весе за период времени: 
Postman endpoint: GET http://localhost:8000/api/dates/{from}&{to}
body:
"from":"2019-08-01",
"to":"2019-08-07"
ответ при валидных данных: выведение данных, статус 200 ОК         
