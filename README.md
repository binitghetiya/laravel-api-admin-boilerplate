# Laravel API (with admin panel) boilerplate
This is a simple boilerplate for laravel(5.5) API with Admin LTE theme.
Here API access token encapsulated with bcrype encryption and used Admin LTE (Admin theme) for Admin module.

## Getting Started
You can download this repo or clone using below command. (folder-name will be project folder in which you want to start your project).
```
git clone https://github.com/binitghetiya/laravel-api-admin-boilerplate.git <folder-name>
```
or from **Download Zip**
```
https://github.com/binitghetiya/laravel-api-admin-boilerplate 
```
### Project Setup
Once you clone or download project go into you folder

>now rename **.env.example** file to **.env** file

### Installing
```
> composer install   (this will install all php library dependencies)
> bower install     (this will install all Admin panel library dependencies)
> npm install     (this will install all laravel mix dependencies)
> php artisan key:generate (this will create a unique key for your peoject and encrypt your access token using this salt)
> chmod -R 755 storage (write permission to generate and store chache views, error logs and system files)
> chmod -R 755 bootstrap (write permission to cache config files)
> npm run dev (To generate all assets files for Admin UI)
```

### Database Config Setup
Create new database (let's say i'm going to use mysql and my database name is laravel-api-admin-boilerplate).
so in my **.env** file will set below parameters.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-api-admin-boilerplate
DB_USERNAME=root
DB_PASSWORD=secret
```
### Migration and Seeders run
After creating database and updating .env file run below commands
```
> php artisan migrate
> php artisan db:seed
```
Migration will create 2 tables users and application
* **application** - this table has all client_id and secret keys which will use to validate every API call
* **users** - this is normal user table with some required fields like (name, email, password, and is_admin)
Seeders will create one new client entry in application and 2 users entry one admin and one normal user.


### Email Config Setup
To verify user we are sending email, so here i have used **gmail** to send email
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=youemail@gmail.com
MAIL_PASSWORD=yourgmailpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreplay@laravelapiadminboilerplate.com
MAIL_FROM_NAME=LaravelApiAdminBoilerplate
```
`php artisan serve` to run your project 
>Everythig is setup and you are good to go now. Happy Coding :)



# Other Information about setup
## Git/Bitbucket Setup
```
> rm -rf .git  (Remove git folder so you can use your own git/bitbucket)
```
## Middlewares
```
> client_check (ClientCheck)  this will check every request comes throw application clients.
> admin_ui_auth (AdminUIAuth) this will check admin auth and it's access.
> api_auth (ApiAuth) this will check user access token that we have return in login response.
```
## Routes
### Login
```
> POST : http:localhost:8000/api/user/login   
> Payload: email, password
> Response : 
{
    "code": 200,
    "data": {
        "id": 12,
        "name": "User",
        "email": "user@gmail.com",
        "unique_id": "5a796c03a2d6e",
        "is_verified": 1,
        "status": 1,
        "created_at": "2018-02-06 08:49:07",
        "updated_at": "2018-02-06 08:49:14"
    },
    "access_token": "eyJpdiI6InRoXC9vN2V4OHJkR21PRGtWeHE1UzhRPT0iLCJ2YWx1ZSI6InVoV0czOXFqQXlVMzVid21yWFFhaHpVRDZEUm44aUVHRG5VMDNCTWpzT1FKMFZpQkZvMFFsTzlja0R3RnVUdWdhbWRXK1U1alNqQlBiMGgzb3lmNGpKaWRoc2JQUlwvXC9mRERqSkJFOU9tR1BtRlNIeUVkSGpaTUZGaHlwS0htR3dDbGlMV3l0a01GMFVrTlwvRGtsMnhLc0hvaDZUZGpGbHBnXC9QQ1ZUUm5KS1M4cGp6MG1nalFxcVwvVmc3c3N0WWJHV3JyalZwXC9MemVHTDRpNnhqNjlIWk43Yzd6YTdaeXhvM0x0Q3pOWnpvVnM9IiwibWFjIjoiZmY2MWM1NzQxODU5NzZiMmU3NDAwODZkODVkZmY4ZjcwYjljNGMxNTU3MTI1NmMxYTI1Mzc1NGFlMDJiNDkwNSJ9"
}
```
### Get user
```
> GET : http:localhost:8000/api/user/me   
> Headers : 
        X-CLIENT-ID (from application table) , 
        X-CLIENT-SECRET (from application table) , 
        Authorization (access token)
> Response : 
{
    "code": 200,
    "data": {
        "id": 12,
        "name": "User",
        "email": "user@gmail.com",
        "unique_id": "5a796c03a2d6e",
        "is_verified": 1,
        "status": 1,
        "created_at": "2018-02-06 08:49:07",
        "updated_at": "2018-02-06 08:49:14"
    }
}
```
### Success Response
```
{
    "code": 200,
    "data": "object or array"
}
```
### Error Response
```
{
    "error": {
        "message": "Please verify your account to login"
    },
    "code": 401
}
```

### Contact 
* Follow [@me](https://twitter.com/binitghetiya) on Twitter
* Email <binitlearning@gmail.com>
