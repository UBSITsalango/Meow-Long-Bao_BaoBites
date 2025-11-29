# 🍽️ BaoBites – Community Recipe Sharing Platform

A community-driven web platform where users can create, share, browse, and save recipes. Features user authentication, complete CRUD operations, favorites, comments, ratings, and a clean animated UI.

**Developed by Team Meow Long Bao** | University of Baguio

---

## ✨ Features

### 👤 User Accounts
- Register, Login, and Logout functionality
- Guest browsing mode with limited access
- Login/Register page restrictions for authenticated users
- Admin panel (optional implementation)

### 📒 Recipe Management
- ✅ Create, Read, Update, Delete recipes (CRUD)
- ✅ Browse all community recipes (Dashboard)
- ✅ Personal "My Recipes" section
- ✅ Detailed recipe pages with ingredients, instructions, category, and creator info

### ❤️ Favorites System
- ✅ Save/unsave favorite recipes (logged-in users only)
- ✅ Dedicated favorites page
- ✅ Quick favorite toggle with AJAX

### ⭐ Ratings & Comments
- ✅ Rate recipes (5-star system)
- ✅ Real-time average rating display
- ✅ User comments with timestamps
- ✅ Guest view-only access (no rate/comment)
- ✅ Users cannot rate their own recipes

### 🎨 UI/UX
- ✅ Animated hero banners with cookie animations
- ✅ Fade-in animations on key pages
- ✅ Mobile-responsive design (Bootstrap 5)
- ✅ Color-themed layout (Orange, Sage, Cream)
- ✅ Smooth AJAX interactions (no page reloads)

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Frontend** | HTML5, CSS3, Bootstrap 5, jQuery |
| **Backend** | PHP 8+ |
| **Database** | MySQL with PDO Prepared Statements |
| **AJAX** | jQuery AJAX |
| **Version Control** | Git & GitHub |

---

## 📁 Project Structure

```
baobites/
├── app/
│   ├── db.php                 # Database connection (PDO)
│   └── auth.php               # Authentication logic
│
├── ajax/                      # AJAX endpoints (no page reload)
│   ├── add_recipe.php
│   ├── add_comment.php
│   ├── add_rating.php
│   ├── delete_recipe.php
│   ├── toggle_favorite.php
│   ├── load_recipe.php
│   ├── load_all_recipes.php
│   ├── load_my_recipes.php
│   └── load_favorites.php
│
├── public/                    # Front-facing pages
│   ├── index.php              # Landing page
│   ├── dashboard.php          # Recipe feed
│   ├── my_recipes.php
│   ├── favorites.php
│   ├── recipe.php             # Recipe details
│   ├── login.php
│   ├── register.php
│   ├── add_recipe.php
│   ├── edit_recipe.php
│   ├── about.php
│   └── contact.php
│
├── assets/
│   ├── css/style.css
│   ├── js/app.js
│   └── images/
│
└── README.md
```

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache or Nginx web server
- Composer (optional, for future packages)

### Steps

#### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/Meow-Long-Bao_BaoBites.git
cd Meow-Long-Bao_BaoBites
```

#### 2️⃣ Create & Configure Database
```bash
# Create database in MySQL
CREATE DATABASE baobites;
USE baobites_db;

# Import schema
SOURCE path/to/schema.sql;
```

#### 3️⃣ Configure Database Connection
Edit `/app/db.php`:
```php
$pdo = new PDO(
    "mysql:host=localhost;dbname=baobites_db", 
    "root", 
    ""
);
```

#### 4️⃣ Update Base URL
Edit `/assets/js/app.js`:
```javascript
const BASE_URL = "/Meow-Long-Bao_BaoBites/baobites";
```

#### 5️⃣ Run Locally
```bash
# Move to htdocs or webroot
cp -r baobites /var/www/html/

# Access in browser
http://localhost/baobites/public/index.php
```

---

## 🎯 Usage

### For Users
1. **Register** at `/public/register.php`
2. **Browse** recipes on the Dashboard
3. **Create** your own recipe via "Add Recipe"
4. **Rate & Comment** on community recipes
5. **Save** favorites to your collection

### For Developers
1. AJAX endpoints in `/ajax/` handle all CRUD operations
2. Database queries use **PDO Prepared Statements** (SQL injection protection)
3. Frontend uses **jQuery** for smooth interactions
4. No page reloads – all updates via AJAX callbacks

---

## 📄 License

This project is for **academic use** under University of Baguio.

---

## 👥 Team

**Team Meow Long Bao** – University of Baguio IT/Computer Science Program

**Made with ❤️ by Team Meow Long Bao**
