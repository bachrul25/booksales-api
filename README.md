# 📚 BookSales API (Laravel 10)

Sebuah API sederhana untuk mengelola data buku dan penulis, dibangun menggunakan Laravel 10.

## 🚀 Fitur

- Manajemen Buku (CRUD)
- Manajemen Penulis (CRUD)
- Relasi antara Buku dan Penulis
- API RESTful siap digunakan
- UI sederhana dan responsif (jika digunakan bersama blade atau frontend)

## 🛠️ Instalasi

```bash
git clone -b bachrul-laravel https://github.com/bachrul25/booksales-api.git
cd booksales-api
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
