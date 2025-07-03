# Laravel Employee CRUD with S3 & Redis  
A technical test project for PHP Intern – by [@ryanzuni](https://github.com/ryanzuni)

This Laravel application allows you to manage employee data with:
- Basic CRUD operations (Create, Read, Update, Delete)
- File upload to Amazon S3 (photo_upload_path stores URL)
- Real-time data cache using Redis (`emp_<nomor>` as key)
- Form UI using Laravel Blade + Bootstrap

---

## Features

- Add employee via form
- View employee list (with photo preview)
- Upload photos to S3
- Save employee data in Redis as JSON
- Flash success messages on form submit

---

## Requirements

- PHP 8.x or later  
- Laravel 10  
- Redis server  
- AWS S3 bucket  
- Composer

---

## Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/ryanzuni/php-intern-test.git
cd php-intern-test
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
php artisan serve/employee-form
php artisan serve/employee-list