<p align="center">
    <img width="200" src="https://github.com/vaneath/dmenu-capstone1/assets/109834020/e980c486-d369-4313-9e55-b30363ff2c84" alt="Dmenu logo">
</p>

# About Dmenu

**Dmenu** is a service provider application that uses to serve service at restaurant by letting customers to order foods by Qr scanning with their mobile phone. Quick and easy!

## Features

- [x] Admin web application (For developer!)
- [x] Restaurant owner web application
- [x] Customer web application

## Demo Application

Follow steps below to demo this system:

### STEP 1: Clone Project

```s
git clone https://github.com/vaneath/dmenu-capstone1.git
```
### STEP 2: Setup environment

```s
cp .env.example .env
```
<img width=300 src="https://github.com/vaneath/dmenu-capstone1/assets/109834020/8aa69fdb-291b-4255-a488-779822bf8c69" />

Go into .env and edit your **DB_USERNAME** and **DB_PASSWORD**

### STEP 3: Install dependencies
```s
composer install
npm install
```

### STEP 4: Link to Public Storage
```s
php artisan storage:link
```

### STEP 5: Migrate database
```s
php artisan migrate
php artisan db:seed
```

### STEP 6: Generate app key
```s
php artisan key:generate
```

### STEP 7: Run DEMNU!!!

You have to open 2 terminals:

***Terminal 1*** 
```s 
npm run dev

```
***Terminal 2*** 
```s 
php artisan serve
```
Now you can register or login with these 2 credentials:

### Admin
**Email:** admin@gmail.com <br/>
**Password:** password

### Restaurant Owner
**Email:** owner@gmail.com <br/>
**Password:** password

<h2 align="center"> DMENU </h2>

