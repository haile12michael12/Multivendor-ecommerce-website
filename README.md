# 🛒 Multi Vendor Ecommerce Project (Laravel 10)

A complete **Multi Vendor Ecommerce Platform** built with **Laravel 10**.  
This project to advanced ecommerce features, making it a solid base for professional use, or commercial deployment.  

---

## 🚀 Features

### 🔑 Authentication & Roles
- Multi-authentication (**Admin, Vendor, User**)
- Password change option for all roles

### 📦 Product Management
- Advanced **Product Management System**
- Multi Vendor product support
- Advanced product search
- Product coupon system
- Product variants feature
- Multi-image upload support
- Product review & rating system
- Product discount system
- Advanced add-to-cart functionality
- Product wishlist feature

### 💳 Payments & Transactions
- Multiple payment gateways integration
- Transaction history tracking
- Advanced order tracking system
- Order management system

### 🚚 Shipping
- Configurable **Shipping Rule System**

### 📊 Analytics & Dashboard
- Interactive dashboard with analytics

### 📰 Content & Engagement
- Blog management system
- Dynamic newsletter system
- Advertisement management

---

## 🛠️ Tech Stack
- **Framework**: Laravel 10
- **Database**: MySQL / PostgreSQL
- **Frontend**: Blade, Bootstrap / Tailwind (customizable)
- **Authentication**: Laravel Breeze / Fortify / Passport (multi-auth setup)
- **Payments**: Stripe, PayPal, Flutterwave, etc. (extendable)


## 📂 Project Setup

### 1️⃣ Clone the Repository

- git clone https://github.com/your-username/multi-vendor-ecommerce.git
cd multi-vendor-ecommerce
2️⃣ Install Dependencies
composer install
npm install && npm run dev

3️⃣ Configure Environment

Copy .env.example to .env and update database, mail, and payment gateway credentials.

cp .env.example .env
php artisan key:generate

4️⃣ Run Migrations & Seeders
php artisan migrate --seed

5️⃣ Start Development Server
php artisan serve


Visit: http://127.0.0.1:8000

# 👥 User Roles

- Admin → Manage vendors, products, orders, payments, advertisements, newsletters, etc.

- Vendor → Manage store products, discounts, coupons, shipping, and transactions.

- User → Browse, search, add to cart, wishlist, review products, and place orders.


# 📈 Future Improvements

AI-powered product recommendations

Multi-language & multi-currency support

Live chat between buyers & vendors

Mobile app integration (Flutter / React Native)

# 🤝 Contributing

Contributions are welcome!
Please fork the repo and create a pull request.

# 📜 License

This project is licensed under the MIT License – free to use and modify.

# 👨‍💻 Author

Developed with ❤️ using Laravel 10.