<?php
require '../app/auth.php';
requireLogin();

include 'header.php';
include 'navbar.php';
?>

<main class="cream-bg">

<section class="py-5 baobites-hero">
    <div class="container text-center">
        <h1 class="fw-bold">Your Favorite Recipes</h1>
        <p class="lead mt-3">Browse, manage, and enjoy the recipes you've saved.</p>
    </div>
</section>

<div class="container mt-4">
    <h2 class="fw-bold mb-1" style="color:#333;">Your Favorites</h2>
    <p class="text-muted mb-3">
        Click a recipe to view it, or tap the heart to remove it.
    </p>

    <div id="favList" class="row mt-3"></div>

    <div id="favEmpty" class="text-center mt-5 d-none">
        <img src="../assets/images/empty.png" style="width:160px; opacity:0.8;">
        <h4 class="mt-3 fw-bold" style="color:#666;">You haven't saved any favorites yet</h4>
        <p class="text-muted">Browse recipes and click the heart to save your favorites.</p>
        <a href="dashboard.php" class="btn orange-btn">Explore Recipes</a>
    </div>
</div>

</main>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
$(function() {

    function renderCard(r) {
        return `
        <div class="col-md-4 col-sm-6 fav-card">
            <div class="card shadow-sm recipe-card" style="border-radius:18px; overflow:hidden;">

                <div style="background:#A3B18A; height:130px; display:flex; align-items:center; justify-content:center; color:white; font-size:3rem;">
                    🍲
                </div>

                <div class="card-body">
                    <h5 class="fw-bold" style="color:#333;">${escapeHtml(r.title)}</h5>
                    <span class="badge" style="background:#E2725B;">${escapeHtml(r.category)}</span>

                    <p class="text-muted mt-1 mb-2" style="font-size:0.9rem;">
                        by ${escapeHtml(r.username)}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="recipe.php?id=${r.recipe_id}"
                           class="btn orange-btn btn-sm fw-semibold"
                           style="border-radius:18px;">
                           View Recipe
                        </a>

                        <span class="favorite-heart active toggleFav"
                              data-id="${r.recipe_id}"
                              title="Remove favorite"
                              style="cursor:pointer; font-size:1.5rem; color:#E2725B;">♥</span>
                    </div>

                </div>

            </div>
        </div>`;
    }

    function loadFavorites() {
        $.get('../ajax/load_favorites.php', function(res) {
            const list = jsonSafeParse(res) || [];

            if (list.length === 0) {
                $("#favList").html("");
                $("#favEmpty").removeClass("d-none");
                return;
            }

            $("#favEmpty").addClass("d-none");

            let html = "";
            list.forEach(r => html += renderCard(r));
            $("#favList").html(html);
        });
    }

    loadFavorites();

    $(document).on("click", ".toggleFav", function () {
        let id = $(this).data("id");

        $.post("../ajax/toggle_favorite.php", { recipe_id: id }, function () {
            $(`[data-id='${id}']`).closest(".fav-card").fadeOut(200, function () {
                $(this).remove();
                loadFavorites();
            });
        });
    });

});
</script>

</body>
</html>
