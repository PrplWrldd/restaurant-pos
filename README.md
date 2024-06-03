**HOW TO RUN PROJECT IN YOUR PC**

1. Clone the Git Repository
Open your terminal or command prompt.
Navigate to your desired project directory.
Use the git clone command to clone the repository.
```
git clone <repository_url> <folder_name>
```
2. Install Composer Dependencies
Laravel uses Composer for PHP dependency management.
Navigate to your project folder.
Run composer install to install PHP dependencies.
```
composer install
```
3. Setup .env
Duplicate the .env.example file and rename it to .env.
Open the .env file and set your database connection details.
**Make an empty database first.**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
4. Generate an application key.
```
php artisan key:generate
```
5. Migrate the Database
Run database migrations to create tables.
```
php artisan migrate
```
6. Seed the Database 
If your project has seeders, use them to populate the database with sample data.
```
php artisan db:seed
```
7. Install Node.js Dependencies 
If your project uses JavaScript or CSS, install Node.js dependencies.
```
npm install
```

8. Compile Assets 
Compile JavaScript and CSS assets with Laravel Mix.
```
 npm run dev
```

9. Start the Development Server
Use Artisan or XAMPP to start the Laravel development server.
```
 php artisan serve
```
