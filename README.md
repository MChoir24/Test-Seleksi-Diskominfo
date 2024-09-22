## Installation

### Prerequisites
- PHP: 8.1.27
- MySQL: 8.0.22
- Composer: 2.7.8
- Git
- Docker (for Sail installation)

### 1. Installation Using Laravel Sail

#### Step 1: Clone the Repository
```bash
git clone https://github.com/username/repository-name.git
cd repository-name
```

#### Step 2: Install Dependencies with Composer
Run the following command to install the required dependencies:
```bash
composer install
```

#### Step 3: Create `.env` File
Copy the `.env.example` to `.env`:
```bash
cp .env.example .env
```

#### Step 4: Generate Application Key
Run the following command to generate the application key:
```bash
./vendor/bin/sail artisan key:generate
```

#### Step 5: Update Environment Variables
In the `.env` file, update the necessary variables such as `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` to match your local environment or the setup you want to use.

#### Step 6: Start Sail
Run Sail to start the application in Docker containers:
```bash
./vendor/bin/sail up
```

#### Step 7: Run Migrations
Run the migrations to set up the database:
```bash
./vendor/bin/sail artisan migrate
```

#### Step 8: Access the Application
You can now access the application at `http://localhost`.

---

### 2. Installation Without Using Laravel Sail

#### Step 1: Clone the Repository
```bash
git clone https://github.com/username/repository-name.git
cd repository-name
```

#### Step 2: Install Dependencies with Composer
Run the following command to install the required dependencies:
```bash
composer install
```

#### Step 3: Create `.env` File
Copy the `.env.example` to `.env`:
```bash
cp .env.example .env
```

#### Step 4: Generate Application Key
Run the following command to generate the application key:
```bash
php artisan key:generate
```

#### Step 5: Update Environment Variables
In the `.env` file, update the necessary variables such as `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` to match your local environment.

#### Step 6: Configure the Web Server
Make sure your local web server (e.g., Apache or Nginx) is properly configured to serve the application. Set the document root to the `public` directory of your Laravel application.

#### Step 7: Set Up the Database
Make sure MySQL is installed and running on your machine. Create a database that matches the name set in the `.env` file:
```bash
mysql -u root -p
CREATE DATABASE database_name;
```

#### Step 8: Run Migrations
Run the migrations to set up the database:
```bash
php artisan migrate
```

#### Step 9: Start the Development Server
You can use Laravel's built-in development server:
```bash
php artisan serve
```

#### Step 10: Access the Application
The application will be accessible at `http://127.0.0.1:8000`.

---

Pastikan `php artisan key:generate` dijalankan pada kedua metode instalasi. Ini sangat penting karena kunci aplikasi digunakan untuk enkripsi yang aman.