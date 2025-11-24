<?php 
require '../app/auth.php'; 
requireLogin(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Recipes - BaoBites</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<?php include 'header.php'; ?>

<body class="cream-bg">

<?php include 'navbar.php'; ?>

<section class="py-5 baobites-hero">
    <div class="container text-center">
        <h1 class="fw-bold">My Recipes</h1>
        <p class="lead mt-2">Manage your creations.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Your Creations</h2>
            <a href="add_recipe.php" class="btn orange-btn" style="border-radius:20px;">+ Add Recipe</a>
        </div>

        <div id="myRecipeList" class="row g-4 mt-2"></div>

        <div id="emptyMyRecipes" class="text-center mt-5 d-none">
            <img src="../assets/images/empty.png" style="width:160px; opacity:0.8;">
            <h4 class="mt-3 fw-bold">You haven’t shared a recipe yet</h4>
            <p class="text-muted">Create your first recipe.</p>
            <a href="add_recipe.php" class="btn orange-btn">Add Your First Recipe</a>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
$(document).ready(function () {

    $.get('../ajax/load_my_recipes.php', function(raw) {

        let recipes = jsonSafeParse(raw) || [];
        let html = "";

        if (recipes.length === 0) {
            $('#emptyMyRecipes').removeClass('d-none');
            return;
        }

        recipes.forEach(r => {
            html += `
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm recipe-card" style="border-radius:18px; overflow:hidden;">

                        <div style="background:#A3B18A; height:120px; display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">🍲</div>

                        <div class="card-body text-start">

                            <h5 class="fw-bold" style="color:#333;">${escapeHtml(r.title)}</h5>

                            <span class="badge" style="background:#E2725B;">${escapeHtml(r.category)}</span>

                            <p class="text-muted mt-1 mb-2" style="font-size:0.9rem;">
                                by You
                            </p>

                            <a href="recipe.php?id=${r.recipe_id}" 
                               class="btn orange-btn btn-sm fw-semibold"
                               style="border-radius:18px;">
                               View
                            </a>

                            <a href="edit_recipe.php?id=${r.recipe_id}" 
                               class="btn btn-sm btn-outline-secondary ms-2">
                                Edit
                            </a>

                            <button class="btn btn-sm btn-danger ms-2 deleteRecipeBtn" 
                                    data-id="${r.recipe_id}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>`;
        });
        $("#myRecipeList").html(html);
    });
});
</script>

</body>
</html>
