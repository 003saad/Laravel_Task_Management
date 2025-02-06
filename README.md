# Task Management System

A simple and efficient task management system built with Laravel, featuring user authentication and CRUD operations for tasks.

## Features

- User Registration and Authentication
- Create, Read, Update, and Delete Tasks
- Mark Tasks as Complete/Incomplete
- Filter Tasks by Status (All, Pending, Completed)
- Responsive Design

## Requirements

- PHP 7.3 or higher
- Composer
- Node.js and NPM
- MySQL

## Installation

1. Clone the repository:
   
git clone [https://github.com/yourusername/task-management-system.git](https://github.com/yourusername/task-management-system.git)

2. Navigate to the project directory:

cd task-management-system

3. Install PHP dependencies:

composer install

4. Install and compile frontend dependencies:

npm install && npm run dev

5. Create a copy of the `.env.example` file and rename it to `.env`:

cp .env.example .env

6. Generate an application key:

php artisan key:generate

7. Configure your database in the `.env` file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

8. Run database migrations:

php artisan migrate

## Usage
1. Start the development server:
   php artisan serve

2. Visit `http://localhost:8000` in your web browser.

3. Register a new account or log in with existing credentials.

4. Start managing your tasks!

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
