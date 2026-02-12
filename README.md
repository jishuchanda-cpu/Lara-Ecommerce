<div align="center">

# 🛍️ Laravel E-Commerce Shop

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-4.x-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

**A modern, full-featured e-commerce platform built with Laravel 12, Livewire 4, and Tailwind CSS**

[Features](#-features) • [Demo](#-demo) • [Installation](#-installation) • [Usage](#-usage) • [Screenshots](#-screenshots) • [Contributing](#-contributing)

</div>
<p align="center">
  <a href="https://myaisorte.wuaze.com/" target="_blank">
    <img src="https://img.shields.io/badge/Live%20Demo-Click%20Here-brightgreen?style=for-the-badge" />
  </a>
</p>

---

## ✨ Features

### 🛒 **Shopping Experience**
- **Product Catalog** - Browse products with advanced filtering and search
- **Category Management** - Organized product categories with hierarchical structure
- **Shopping Cart** - Real-time cart updates with Livewire
- **Authentication Required** - Secure cart with login/registration modal
- **Checkout Process** - Streamlined multi-step checkout flow
- **Order Management** - Track orders with detailed history

### 🎨 **Modern UI/UX**
- **Responsive Design** - Mobile-first approach with Tailwind CSS
- **Dark Mode Support** - Automatic theme switching
- **Real-time Updates** - Livewire-powered reactive components
- **Beautiful Animations** - Smooth transitions and micro-interactions
- **Image Previews** - Live image upload previews

### 🔐 **Authentication & Security**
- **User Registration** - Secure account creation with validation
- **Login System** - Email/password authentication
- **Role-based Access** - Admin and customer roles
- **Session Management** - Secure session handling
- **CSRF Protection** - Built-in Laravel security

### 📦 **Product Management**
- **Image Upload System** - Multi-image upload with preview
- **File Storage** - Organized storage with automatic cleanup
- **CRUD Operations** - Complete product management
- **Stock Tracking** - Inventory management
- **Pricing Control** - Flexible pricing options

### 💰 **Payment & Discounts**
- **Coupon System** - Percentage and fixed-amount discounts
- **Usage Tracking** - Per-user and global coupon limits
- **Minimum Order Amount** - Conditional coupon application
- **Expiration Dates** - Time-limited promotions

### 📊 **Admin Panel**
- **Dashboard** - Overview of sales and orders
- **Product Management** - Add, edit, delete products
- **Order Management** - Process and track orders
- **User Management** - Manage customer accounts
- **Coupon Management** - Create and manage discount codes

---

## 🚀 Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 12.x | Backend framework |
| **Livewire** | 4.x | Reactive components |
| **Tailwind CSS** | 3.x | Styling framework |
| **PHP** | 8.2+ | Server-side language |
| **MySQL** | 8.0+ | Database |
| **Vite** | Latest | Asset bundling |
| **Alpine.js** | 3.x | Lightweight JS framework |

---

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM or Yarn
- MySQL >= 8.0
- Git

---

## 🚀 Demo

<p align="left">
  <a href="https://myaisorte.wuaze.com/" target="_blank">
    🌐 Click Here to View Live Application
  </a>
</p>

MyAISorte is an intelligent AI-powered platform that streamlines modern E-commerce platform. Built with an agentic-first mindset, it combines Antigravity and OpenCode technologies to deliver efficient and smart coding assistance.


### Admin Account
- **Email:** admin@admin.com
- **Password:** password

### Test Customer
- **Email:** test@example.com
- **Password:** password

> ⚠️ **Important:** Change these credentials in production!

---

## 🔧 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-ecommerce-shop.git
cd laravel-ecommerce-shop
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lara_ai
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Create storage symlink
php artisan storage:link
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## 👤 Default Credentials

### Admin Account
- **Email:** admin@admin.com
- **Password:** password

### Test Customer
- **Email:** test@example.com
- **Password:** password

> ⚠️ **Important:** Change these credentials in production!

---

## 📖 Usage

### Customer Flow

1. **Browse Products** - Navigate through categories or search
2. **Add to Cart** - Click "Add to Cart" (requires login)
3. **Authentication** - Login or register via modal
4. **Checkout** - Review cart and complete order
5. **Track Orders** - View order history and status

### Admin Flow

1. **Login** - Use admin credentials
2. **Manage Products** - Add/edit/delete products with images
3. **Process Orders** - View and update order status
4. **Create Coupons** - Set up discount codes
5. **View Reports** - Monitor sales and inventory

---

## 🎨 Key Features Explained

### Authentication Modal
- Dual-mode modal (Login/Register)
- Tab switching interface
- Real-time validation
- Auto-retry cart action after login

### Image Upload System
- Multi-image upload support
- Live preview before upload
- Drag-and-drop functionality
- Automatic file cleanup on delete
- Supported formats: JPEG, PNG, JPG, GIF, WEBP
- Max file size: 2MB per image

### Coupon System
- **Types:** Percentage or Fixed Amount
- **Restrictions:** Minimum order amount
- **Limits:** Max uses per user and globally
- **Validation:** Date range and active status

---

## 📁 Project Structure

```
laravel-ecommerce-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/
│   │   │       └── ProductController.php
│   │   └── Requests/
│   ├── Livewire/
│   │   ├── AuthModal.php
│   │   └── Shop/
│   │       ├── AddToCart.php
│   │       └── ProductListing.php
│   └── Models/
│       ├── Product.php
│       ├── Order.php
│       ├── Coupon.php
│       └── CouponUsage.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── products/
│   │   ├── checkout/
│   │   └── livewire/
│   └── css/
└── routes/
    └── web.php
```

---

## 🗄️ Database Schema

### Main Tables
- `users` - User accounts and authentication
- `products` - Product catalog
- `categories` - Product categories
- `orders` - Customer orders
- `order_items` - Order line items
- `coupons` - Discount codes
- `coupon_usages` - Coupon usage tracking

---

## 🔌 API Endpoints

### Public Routes
```
GET  /                    - Home page
GET  /products            - Product listing
GET  /products/{id}       - Product details
GET  /categories/{id}     - Category products
```

### Authenticated Routes
```
GET  /cart                - Shopping cart
POST /checkout            - Process checkout
GET  /orders              - Order history
GET  /orders/{id}         - Order details
```

### Admin Routes
```
GET  /admin/dashboard     - Admin dashboard
GET  /admin/products      - Product management
GET  /admin/orders        - Order management
GET  /admin/coupons       - Coupon management
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

---

## 🚀 Deployment

### Production Checklist

- [ ] Update `.env` with production credentials
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `npm run build`
- [ ] Set up SSL certificate
- [ ] Configure proper file permissions
- [ ] Set up automated backups
- [ ] Configure queue workers
- [ ] Set up monitoring and logging

### Recommended Hosting
- Laravel Forge
- DigitalOcean
- AWS
- Heroku
- Cloudways

---

## 🛠️ Development

### Running Development Environment

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev

# Terminal 3: Run queue worker (optional)
php artisan queue:work
```

### Code Style

This project follows PSR-12 coding standards. Run Pint for code formatting:

```bash
./vendor/bin/pint
```

---

## 📝 Environment Variables

Key environment variables:

```env
APP_NAME="Laravel Shop"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lara_ai
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Contribution Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation
- Keep commits atomic and descriptive

---

## 🐛 Bug Reports

Found a bug? Please open an issue with:
- Clear description of the problem
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)
- Environment details

---

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**JISHU**

- GitHub: [@jishuchanda-cpu](https://github.com/jishuchanda-cpu)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework
- [Livewire](https://livewire.laravel.com) - Reactive components
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Heroicons](https://heroicons.com) - Beautiful icons

---

## 📊 Project Stats

- **Total Files:** 100+
- **Lines of Code:** 10,000+
- **Development Time:** 6+ hours
- **Features:** 20+
- **Database Tables:** 15+

---

## 🗺️ Roadmap

### Upcoming Features
- [ ] Payment gateway integration (Stripe, PayPal)
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Advanced search with filters
- [ ] Email notifications
- [ ] Invoice generation
- [ ] Multi-language support
- [ ] Product variants (size, color)
- [ ] Inventory alerts
- [ ] Analytics dashboard

---

## ⭐ Show Your Support

If you find this project helpful, please give it a ⭐ on GitHub!

---

<div align="center">

**Built with ❤️ using Laravel, Livewire, and Tailwind CSS**

© 2026 JISHU. All rights reserved.

</div>
