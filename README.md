# Laravel With mongoDB Project Setup

This README will guide you through setting up and running the Laravel project locally.

## Prerequisites

Ensure the following tools are installed on your system:
🔧 Tech Stack:

-   PHP >= 8.2
-   Laravel = 12
-   Composer
-   mongoDB

## Installation & Setup

Follow the steps below to get started:

```bash
# Clone the repository
git clone https://github.com/shayanahmad1999/laravel-mongodb.git
cd folder_name

# Install PHP dependencies
composer install

# Install npm dependencies
npm install
npm run build

# Copy and set up the environment configuration
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 🧩 Install the MongoDB PHP Extension

**For Windows/XAMPP:**

-   Download DLL: [MongoDB Extension v2.1.1](http://pecl.php.net/package/mongodb/2.1.1/windows)
-   Place it in: `C:\xampp\php\ext`
-   Enable the extension in `php.ini`:

```

extension=php_mongodb.dll

```

-   Restart your web server

Verify it's installed:

```bash
php -m | grep mongodb
```

---

### 🔧 Configure the Database Connection

Edit `config/database.php`:

```php
'default' => env('DB_CONNECTION', 'mongodb'),

'mongodb' => [
            'driver' => 'mongodb',
            'dsn' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
        ],
```

Update your `.env` file:

```
DB_CONNECTION=mongodb
DB_HOST=mongodb+srv://yourUsername:yourPassword@cluster0.deq4zsp.mongodb.net/
DB_DATABASE=yourDatabaseName

```

---

### 🌐 Set Up MongoDB Atlas (Cloud)

-   Visit [mongodb.com](https://www.mongodb.com/)
-   Create an account and a new project
-   Add IP access in the **Network Access** tab (allow all or specific IPs)
-   Create a cluster and copy your URI:
    ```
    mongodb+srv://username:password@cluster0.deq4zsp.mongodb.net/
    ```
-   Paste it into `.env` as shown above

---
```
# Run database migrations

php artisan migrate --seed

# Run the development server again

npm run dev
php artisan serve

```

## Or Setup New Project Laravel With mongooDB

# 🚀 Laravel + MongoDB Integration Guide

This project integrates the Laravel framework with MongoDB for robust, scalable, and flexible NoSQL data handling.

---

## 📦 Step-by-Step Setup Instructions

### 1. 🧩 Install the MongoDB PHP Extension

**For Windows/XAMPP:**

-   Download DLL: [MongoDB Extension v2.1.1](http://pecl.php.net/package/mongodb/2.1.1/windows)
-   Place it in: `C:\xampp\php\ext`
-   Enable the extension in `php.ini`:

```

extension=php_mongodb.dll

````

-   Restart your web server

Verify it's installed:

```bash
php -m | grep mongodb
````

---

### 2. ⚙️ Install Laravel MongoDB Package

Run:

```bash
composer require mongodb/laravel-mongodb
```

---

### 3. 🔧 Configure the Database Connection

Edit `config/database.php`:

```php
'default' => env('DB_CONNECTION', 'mongodb'),

'mongodb' => [
            'driver' => 'mongodb',
            'dsn' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
        ],
```

Update your `.env` file:

```
DB_CONNECTION=mongodb
DB_HOST=mongodb+srv://yourUsername:yourPassword@cluster0.deq4zsp.mongodb.net/
DB_DATABASE=yourDatabaseName

```

---

### 4. 🌐 Set Up MongoDB Atlas (Cloud)

-   Visit [mongodb.com](https://www.mongodb.com/)
-   Create an account and a new project
-   Add IP access in the **Network Access** tab (allow all or specific IPs)
-   Create a cluster and copy your URI:
    ```
    mongodb+srv://username:password@cluster0.deq4zsp.mongodb.net/
    ```
-   Paste it into `.env` as shown above

---

### 5. ✅ Test the Connection

In `routes/web.php` or `routes/api.php`:

```php
use MongoDB\Client;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    try {
        $client = new Client(env('DB_HOST'));
        $client->listDatabases();
        return response()->json(['msg' => '✅ MongoDB is accessible!']);
    } catch (\Exception $e) {
        return response()->json(['msg' => '❌ Could not connect to MongoDB: ' . $e->getMessage()]);
    }
});
```

---

### 6. 🧱 Sample MongoDB Model

Create a model with `MongoDB\Laravel\Eloquent\Model;`:

```php
use MongoDB\Laravel\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';
}
```

Then test it with a route:

```php
Route::get('/test/posts', function () {
    return Post::all();
});
```

---

### 7. 🚦 Run Laravel Dev Server

```bash
php artisan serve
```

---

## ✨ Credits

-   Laravel Framework
-   MongoDB Atlas

---

## 📄 License

This project is open-source under the [MIT License](https://opensource.org/licenses/MIT).

```

```
