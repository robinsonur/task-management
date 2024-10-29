<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img
            src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"
            width="400"
            alt="Laravel Logo"
        />
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

## Instructions to Start the Task Management API Project (Windows)

To start the Laravel project from a repository, please follow the detailed steps below. Ensure you have the necessary requirements installed before proceeding.

## Requirements

1. **Database Engine**: MySQL (or MariaDB) is required to run the database for this project.
2. **PHP Version**: PHP 8.3 or later. It is recommended to use [Laravel Herd](https://herd.laravel.com/) as it simplifies environment setup for Laravel projects, including PHP, MySQL, and other necessary extensions.

## Setup Instructions

### 1. Clone the Repository
Clone the project repository and navigate into the project directory.
```sh
git clone https://github.com/robinson-urena-hytech/task-management.git
cd task-management
```

### 2. Install Dependencies
Use Composer to install all necessary dependencies.
```sh
composer install
```

### 3. Copy the Environment Configuration File
Copy the sample environment file and create your `.env` file.
```sh
cp .env.example .env
```

### 4. Generate the Application Key
Generate a unique application key for Laravel.
```sh
php artisan key:generate
```

### 5. Configure the `.env` File
Open the `.env` file and update the following settings:
- Database Configuration: Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` to match your MySQL setup.
- Other Settings: Modify other configurations as needed.
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Database Migrations
Apply the database schema with migrations.
```sh
php artisan migrate:fresh --seed
```

### 8. Start the Development Server
Start Laravel’s development server to test the application locally.
```sh
php artisan serve
```

### 9. You can sign in with the following credentials:
- **Email**: administrator@domain.com
- **Password**: Administrator
- **PATH END POINT**: /api/signIn [POST]

## Additional Notes
- Using Laravel Herd: If you're using Laravel Herd, it will automatically configure PHP, MySQL, and necessary dependencies. Simply ensure Herd is installed and running, then navigate to the project folder and run:
```bash
herd serve
```
