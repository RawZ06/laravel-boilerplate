<p align="center">
  <img src="doc/logo.svg" width="400" alt="Boilerplate Logo">
</p>

<h1 align="center">Laravel Boilerplate</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/Hotwire_Turbo-000000?style=for-the-badge&logo=hotwire&logoColor=white" alt="Hotwire Turbo">
</p>

<p align="center">
  <img src="https://github.com/RawZ06/laravel-boilerplate/actions/workflows/tests.yml/badge.svg" alt="Build Status">
  <img src="https://github.com/RawZ06/laravel-boilerplate/actions/workflows/docker-check.yml/badge.svg" alt="Docker Status">
  <img src="https://img.shields.io/github/v/tag/RawZ06/laravel-boilerplate?label=version" alt="Latest Stable Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

<p align="center">
  A robust and ready-to-use Laravel 13 boilerplate built for speed, consistency, and a modern developer experience.
</p>

---

## 🚀 Overview

This boilerplate provides a solid foundation for your next Laravel application. It comes pre-configured with the latest tools and a set of custom components to accelerate your development workflow.

## ✨ Features

- **Laravel 13**: Powered by the latest version of the PHP framework.
- **Modern Frontend Stack**:
  - **Tailwind CSS 4.0**: For utility-first styling.
  - **Alpine.js**: For lightweight interactivity.
  - **Hotwire Turbo**: For fast, SPA-like navigation.
  - **Vite**: For ultra-fast frontend builds.
- **Rich Component Library**: A comprehensive set of Blade components for UI building:
  - **Forms**: Input, Select, Checkbox, Radio, Date, Toggle, Color, and more.
  - **UI Elements**: Buttons, Badges, Alerts, Toasts, Breadcrumbs.
  - **Layouts**: Modals, Dropdowns, and Nav components.
  - **Tables**: Built-in search, filtering, and pagination.
- **Backend Admin Features**:
  - **User Management**: Simple and effective user handling.
  - **Audit Logging**: Track actions within the application.
- **Development Ready**: Custom `composer` scripts for quick setup and development.

## 🛠️ Getting Started

### Prerequisites

- PHP 8.4 or higher
- Node.js & NPM/PNPM
- SQLite (default) or any other supported database

### Quick Setup

Clone the repository and run the setup command:

```bash
composer setup
```

This will:
- Install PHP dependencies.
- Create your `.env` file.
- Generate the application key.
- Run database migrations.
- Install and build frontend assets.

### Local Development

Start all development services (server, queue, vite, and logs) with a single command:

```bash
composer dev
```

## 📜 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
