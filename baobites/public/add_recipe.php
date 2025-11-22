<?php 
require '../app/auth.php'; 
requireLogin(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Recipe - BaoBites</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<?php include 'header.php'; ?>

<body class="cream-bg">

<?php include 'navbar.php'; ?>

<section class="py-5 baobites-hero">
    <div class="container text-center">
        <h1 class="fw-bold" style="color:#333;">Share Your Recipe</h1>
        <p class="lead mt-2" style="color:#444;">Create a new dish for the BaoBites community</p>
    </div>
</section>

<section class="py-5">
    <div class="container" style="max-width: 750px;">

        <h2 class="fw-bold mb-3" style="color:#E2725B;">Add New Recipe</h2>
        <div id="addRecipeMsg" class="alert d-none"></div>

        <form id="addRecipeForm" 
              class="p-4 p-md-5 bg-white shadow-sm rounded" 
              style="border-radius:20px; animation: fadeUp 0.5s ease;">

            <div class="mb-3">
                <label class="form-label fw-semibold">Recipe Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ingredients</label>
                <textarea name="ingredients" rows="5" class="form-control" 
                          placeholder="List ingredients here..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Instructions</label>
                <textarea name="instructions" rows="6" class="form-control" 
                          placeholder="Write step-by-step instructions..." required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Category</label>
                <select name="category" class="form-select" required>
                    <option>Main Dish</option>
                    <option>Dessert</option>
                    <option>Snack</option>
                    <option>Beverage</option>
                    <option>Other</option>
                </select>
            </div>
            <button class="btn orange-btn w-100 py-2 fw-semibold">
                Publish Recipe
            </button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>
</body>
</html>
