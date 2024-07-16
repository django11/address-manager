# UK Address Manager 

This guide will help you get your Laravel application up and running in no time.

## Prerequisites

Before you start, make sure you have the following software installed on your machine:

1. **PHP** (version 8.2 or higher)
2. **Composer** (dependency management for PHP)
3. **Git** (version control system)

## Steps to Set Up the Project

### 1. Clone the Repository

Clone the project repository from GitHub (or any other version control system you are using):

```bash
git clone git@github.com:django11/address-manager.git
cd address-manager
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

### 3. Set Up Environment File

Copy the `.env.example` file to create a new `.env` file:

```bash
cp .env.example .env
```

Open the `.env` file and update the necessary environment variables, particularly the database configuration and api keys:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

```env
GET_ADDRESS_API_URL=https://api.getAddress.io
GET_ADDRESS_TOKEN=
```

### 4. Generate Application Key

Generate a new application key:

```bash
php artisan key:generate
```

### 5. Run Database Migrations

Run the database migrations to set up the database schema:

```bash
php artisan migrate
```

### 6. Serve the Application

Serve the application locally:

```bash
php artisan serve
```

By default, the application will be accessible at `http://localhost:8000`.

## Additional Commands

Here are some additional commands that might be useful:

- **Run Tests**:

  ```bash
  php artisan test
  ```

## Conclusion

You should now have a fully functional Laravel application running on your local machine. For more detailed documentation, visit the [Laravel Official Documentation](https://laravel.com/docs).

Happy coding!
