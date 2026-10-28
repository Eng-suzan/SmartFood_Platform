# 🍔 Smart Food AI

### AI-Powered Food Ordering Platform

Smart Food AI is a web-based food ordering platform built with **Laravel, PHP, and MySQL**. It provides separate role-based experiences for customers, restaurant owners, and administrators, alongside an AI-powered chatbot that helps users discover food options and explore restaurant menus.

The platform integrates **Google Gemini AI** for conversational food assistance and **PayPal** to demonstrate the online payment workflow in a testing environment.

## ✨ Features

### 👤 1. Customer
- Register and log in to a customer account.
- Browse restaurants and explore food menus.
- View food items, prices, and availability.
- Place food orders and track order statuses.
- Choose between PayPal and cash payment methods.
- Chat with the AI assistant to discover meals and get food recommendations.

### 🏪 2. Restaurant Owner
- Register and log in as a restaurant owner.
- Manage restaurant information.
- Add and update food menu items.
- Manage food prices and availability.
- View customer orders and update their statuses.

### 🛡️ 3. Admin
- Access the administration dashboard.
- Oversee platform operations.
- Manage platform data according to assigned permissions.

### 🤖 4. AI-Powered Chatbot
- Integrated with the Google Gemini API.
- Supports conversational interaction for food discovery.
- Helps customers explore menu options and find suitable meals.
- Designed to provide relevant recommendations using application data.

### 💳 5. Payment Integration
- PayPal integration for testing and demonstrating the online payment workflow.
- Cash payment option.
- Payment records containing amounts, methods, statuses, transaction references, and timestamps.

> **Note:** PayPal is integrated for testing purposes; the project does not claim to process real-money transactions.

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend programming language |
| Laravel | Web application framework |
| MySQL | Relational database |
| Google Gemini API | AI chatbot integration |
| PayPal | Payment workflow integration for testing |
| HTML5 | Page structure |
| CSS3 | Styling |
| JavaScript | Frontend interactivity |
| Bootstrap | Responsive UI design |

## ⚙️ Installation and Setup

### Prerequisites
- PHP
- Composer
- MySQL
- Node.js and npm
- A Google Gemini API key

### Steps

**1. Clone the repository**

```bash
git clone https://github.com/Eng-suzan/SmartFood_Platform.git
cd SmartFood_Platform
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Configure the environment**

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database credentials and API settings in the `.env` file.

**4. Run database migrations**

```bash
php artisan migrate
```

If the project includes seeders, run them when appropriate:

```bash
php artisan db:seed
```

**5. Install frontend dependencies**

```bash
npm install
npm run build
```

**6. Start the development server**

```bash
php artisan serve
```

Open the local URL displayed in your terminal to access the application.

## 🔐 Environment Configuration

Configure the required environment variables according to the integrations implemented in the project.

- Database connection settings.
- Google Gemini API key.
- PayPal credentials and environment settings, if required by the implementation.

**Important:** Never commit `.env` files, API keys, PayPal credentials, or other secrets to GitHub.

## 🎯 Project Objective

The goal of Smart Food AI is to improve the online food ordering experience by combining restaurant and menu management, customer ordering, administrative functionality, AI-assisted food discovery, and payment workflow integration in one platform.

## 👩‍💻 Developer

**Suzan Reda**

- GitHub: [Eng-suzan](https://github.com/Eng-suzan)
- Project Repository: [SmartFood_Platform](https://github.com/Eng-suzan/SmartFood_Platform)

---

*Developed as a Laravel web application integrating AI-assisted food discovery and online payment workflow testing.*
