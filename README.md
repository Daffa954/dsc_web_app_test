# 📝 Task Management Application

A robust, responsive, and feature-rich Task Management application built with **Laravel 12**. This project was developed with a strong focus on **Clean Architecture** (Fat Models, Skinny Controllers), responsive UI/UX design, and modular code organization.

## ✨ Key Features

* **Complete CRUD Operations:** Easily create, read, update, and delete tasks and categories.
* **Smart Filtering & Search:** * Search tasks by keywords in real-time.
  * Filter tasks by Status (Pending/Completed) and Category.
* **Advanced Sorting:** Sort tasks by Latest, Oldest, Due Date (Nearest/Furthest), and Priority Level (High/Medium/Low).
* **Responsive Design:** Built with Tailwind CSS. Implements a responsive data table for desktop and an intuitive card-based layout for mobile devices.
* **Reusable UI Components:** Utilizes Laravel Blade Components for tables, forms, and alerts to maintain the DRY (Don't Repeat Yourself) principle.
* **Custom User Feedback:** Features elegant, auto-closing flash notifications for success messages, and closable alerts for errors.
* **Optimized Pagination:** Custom Tailwind-styled pagination that retains query strings (filters and sorting) across pages.
* **Database Integrity:** Implements safe deletion (`nullOnDelete`) so deleting a category doesn't wipe out associated tasks.

## 🛠️ Tech Stack

* **Backend:** Laravel 12 (PHP)
* **Frontend:** Blade Templating, Tailwind CSS
* **Database:** MySQL
* **Architecture:** MVC (Model-View-Controller)

## 🚀 Getting Started

Follow these instructions to set up the project on your local machine.

### Prerequisites
Make sure you have the following installed:
* PHP >= 8.2
* Composer
* MySQL or MariaDB

### Installation Setup

1. **Clone the repository**
   ```bash
   git clone [https://github.com/yourusername/your-repo-name.git](https://github.com/yourusername/your-repo-name.git)
   cd your-repo-name
2. **Install PHP dependencies**
    ```bash
   composer install
3. **Environment Setup**
    Copy the .env.example file and rename it to .env.

    ```Bash
    cp .env.example .env
    ```

    Generate the application key:
    ```Bash
    php artisan key:generate
    ```

4. **Database Configuration**
    Open the .env file and configure your database credentials:


    ```Code snippet
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```
    
5. **Migrate Database**
    Run Migrations
    Create the database tables:

    ```Bash
    php artisan migrate

6. **Run the Application** 
    
    Build The assets
    ```Bash
    npm run build
    ```

    Serve the Application
    Start the local development server:

    ```Bash
    php artisan serve
    ```
    
    Visit http://localhost:8000 in your browser.
