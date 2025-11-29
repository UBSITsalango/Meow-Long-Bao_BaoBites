<?php 
session_start();
include 'header.php';

if (isset($_SESSION['user_id'])) include 'navbar.php';
else include 'navbar_guest.php';
?>

<main class="cream-bg">

<section class="py-5 baobites-hero">
    <div class="container text-center">
        <h1 class="fw-bold" style="color:#333;">
            <?= isset($_SESSION['user_id']) ? "Welcome Back to BaoBites" : "Browse Recipes"; ?>
        </h1>
        <p class="lead mt-2" style="color:#444;">
            <?= isset($_SESSION['user_id'])
                ? "Discover new dishes and share your creations!"
                : "Explore the community’s recipes — or log in to join the fun!"; ?>
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color:#333;">Your Recipe Feed</h2>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="add_recipe.php"
                   class="btn orange-btn fw-semibold"
                   style="border-radius:20px;">
                   + Add Recipe
                </a>
            <?php endif; ?>
        </div>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="alert alert-warning">
                You are browsing as a guest.
                <a href="login.php" style="color:#E2725B; font-weight:bold;">Login</a>
                to create recipes and interact with the community.
            </div>
        <?php endif; ?>

        <div id="recipeList" class="row g-4 mt-2"></div>

        <div id="emptyState" class="text-center mt-5 d-none">
            <img src="../assets/images/empty.png"
                 style="width:160px; opacity:0.8;">
            <h4 class="mt-3 fw-bold" style="color:#666;">No recipes found</h4>
            <p class="text-muted">
                <?= isset($_SESSION['user_id'])
                    ? "Start by adding your first recipe!"
                    : "Try refreshing or logging in to see more."; ?>
            </p>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="add_recipe.php" class="btn orange-btn" style="border-radius:20px;">Add Recipe</a>
            <?php endif; ?>
        </div>

    </div>
</section>

</main>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
$(document).ready(function () {

    loadAllRecipes(() => {
        if (!allRecipes.length) {
            $("#emptyState").removeClass("d-none");
            return;
        }

        let html = "";

        allRecipes.forEach(r => {
            html += `
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm recipe-card" style="border-radius:18px; overflow:hidden;">
                    <div style="background:#A3B18A; height:130px; display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">🍲</div>

                    <div class="card-body">
                        <h5 class="fw-bold" style="color:#333;">${r.title}</h5>
                        <span class="badge" style="background:#E2725B;">${r.category}</span>
                        <p class="text-muted mt-1 mb-2" style="font-size:0.9rem;">by ${r.username}</p>

                        <a href="recipe.php?id=${r.recipe_id}"
                           class="btn orange-btn btn-sm fw-semibold"
                           style="border-radius:18px;">
                           View Recipe
                        </a>
                    </div>
                </div>
            </div>`;
        });

        $("#recipeList").html(html);
    });

});
</script>
</body>
</html>
