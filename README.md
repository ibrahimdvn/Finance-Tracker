# Personal Finance Tracker

A classic, corporate-style personal finance management application built with PHP Laravel. This project allows users to manage income and expense categories, record transactions, and analyze their financial data through comprehensive reports.

## Features

- **User Authentication**: Secure login and registration system.
- **Category Management**: Create, edit, and delete income/expense categories.
- **Transaction Management**: Add, edit, and delete income/expense transactions with date, amount, category, and description.
- **Dashboard**: Overview of recent transactions and financial summary.
- **Reporting & Analysis**:
  - Filter transactions by date range.
  - Category-wise income and expense summaries.
  - Total income, total expense, and balance calculation.
  - Minimum, maximum, and average analysis for both income and expenses.
- **Classic CSS UI**: Clean, corporate look without Tailwind or modern frameworks.
- **Fully English Interface**: All forms, tables, and reports are in English.

## Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd finance-tracker
   ```
2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```
3. **Copy and configure environment file:**
   ```bash
   cp .env.example .env
   # Edit .env to set your database credentials
   ```
4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
5. **Run migrations:**
   ```bash
   php artisan migrate
   ```
6. **(Optional) Seed the database:**
   ```bash
   php artisan db:seed
   ```
7. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage

- Register a new user or log in.
- Manage your income and expense categories from the Categories menu.
- Add new transactions (income or expense) with details such as date, amount, category, and description.
- View, edit, or delete transactions from the Transactions page.
- Access the Reports page to filter transactions by date and analyze your financial data with summaries and statistics.

## Project Structure

- `app/Http/Controllers/` - Controllers for authentication, categories, transactions, and reports.
- `resources/views/` - Blade templates for all pages and components.
- `routes/web.php` - Web routes for the application.
- `public/` - Public assets (CSS, JS, images).

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 9.x
- MySQL or compatible database
- Node.js & npm (for frontend assets)

## License

This project is for educational purposes.
