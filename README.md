🍽️ BaoBites – Community Recipe Sharing Platform

A Web-Based Recipe Sharing System by Team Meow Long Bao

BaoBites is a community-driven web platform where users can create, share, browse, and save recipes. It features user authentication, CRUD operations for recipes, favorites, comments, and ratings — all wrapped in a clean, animated UI built with PHP, MySQL, AJAX, and Bootstrap.

📌 Features
👤 User Accounts

Register, Login, Logout

Guest browsing mode with limited access

Users cannot access login/register when already logged in

Admin panel (optional if implemented)

📒 Recipe Management

Add, edit, delete recipes

View all community recipes (dashboard)

“My Recipes” section

Detailed recipe page with ingredients, instructions, category, and creator info

❤️ Favorites

Logged-in users can favorite/unfavorite recipes

Favorites page with list of saved recipes

⭐ Ratings & Comments

Users can rate recipes (except their own)

Average rating displayed

Comments section with user name and timestamp

Guests can view but cannot rate or comment

✨ UI/UX

Animated hero banners with cookie animation

Fade-in animations on select pages

Mobile-friendly responsive design

Color-themed layout (orange, sage, cream)

🏗️ Tech Stack
Layer	Technology
Frontend	HTML, CSS, Bootstrap 5, jQuery
Backend	PHP 8+
Database	MySQL (PDO Prepared Statements)
AJAX	jQuery AJAX (no page reloads for CRUD)
📁 Folder Structure
baobites/
│
├── app/
│   ├── db.php
│   ├── auth.php
│
├── ajax/
│   ├── add_recipe.php
│   ├── add_comment.php
│   ├── add_rating.php
│   ├── delete_recipe.php
│   ├── toggle_favorite.php
│   ├── load_recipe.php
│   ├── load_all_recipes.php
│   ├── load_my_recipes.php
│   ├── load_favorites.php
│   └── (other AJAX files)
│
├── public/
│   ├── index.php
│   ├── dashboard.php
│   ├── my_recipes.php
│   ├── favorites.php
│   ├── recipe.php
│   ├── login.php
│   ├── register.php
│   ├── about.php
│   ├── contact.php
│   ├── add_recipe.php
│   └── edit_recipe.php
│
├── assets/
│   ├── css/style.css
│   ├── js/app.js
│   ├── images/
│
└── README.md

⚙️ Installation Guide
1️⃣ Clone the repository
git clone https://github.com/your-repo/baobites.git

2️⃣ Import the database

Create a MySQL database

Import the provided SQL schema (recipes, users, favorites, ratings, comments)

3️⃣ Configure database connection

Edit /app/db.php:

$pdo = new PDO("mysql:host=localhost;dbname=baobites_db", "root", "");

4️⃣ Set project base URL

In /assets/js/app.js, update:

const BASE_URL = "/Meow-Long-Bao_BaoBites/baobites";

5️⃣ Run the system

Place the project inside htdocs or your server folder:

http://localhost/baobites/public/index.php

🔐 Account Rules

Logged-in users cannot access login/register pages

Guests can view recipes but cannot:
✓ Comment
✓ Rate
✓ Favorite

Users cannot rate their own recipe

Users can delete only their own recipes

🚀 Recent Updates

Added guest-friendly recipe view

Disabled rating & favorite features for guests

Prevented users from rating their own recipes

Fixed fade-in animations on specific pages only

General UI fixes + improved navbar consistency

Cookie animation tweaks

Security tweaks on AJAX endpoints

📝 License

This project is for academic use under University of Baguio.