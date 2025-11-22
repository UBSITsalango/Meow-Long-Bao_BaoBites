<?php
require '../../app/auth.php';
requireAdmin();
include '../header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Recipes - BaoBites</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<?php include 'admin_sidebar.php'; ?>

<div id="adminMain" class="admin-main">
    <nav class="navbar bg-white shadow-sm topbar">
        <div class="container-fluid">
            <h5 class="fw-bold mb-0">Manage Recipes</h5>
        </div>
    </nav>

    <div class="container py-4">

        <div class="card shadow-sm rounded-4">
            <div class="card-body">

                <table class="table table-hover align-middle recipes-table">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th width="240"></th>
                        </tr>
                    </thead>
                    <tbody id="recipeTable"></tbody>
                </table>

            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function () {
    loadRecipes();
});

function loadRecipes() {
    $.get('../../ajax/load_all_recipes.php', function (res) {
        let list = JSON.parse(res || "[]");
        let html = "";

        list.forEach(r => {
            let featuredBadge = r.is_featured ? 
                `<span class="badge bg-warning text-dark">⭐ Featured</span>` : 
                `<span class="text-muted">—</span>`;

            let featureBtn = r.is_featured
                ? `<button class="btn btn-outline-warning btn-sm feature-btn removeFeaturedBtn" data-id="${r.recipe_id}">
                        Remove
                </button>`
                : `<button class="btn btn-warning btn-sm feature-btn setFeaturedBtn" data-id="${r.recipe_id}">
                        Feature
                </button>`;

            html += `
                <tr>
                    <td>${r.title}</td>
                    <td>${r.username}</td>
                    <td>${r.category}</td>
                    <td>${featuredBadge}</td>
                    <td>
                        <div class="action-buttons">
                            <a class="btn btn-sm btn-primary" href="recipe_admin.php?id=${r.recipe_id}">View</a>
                            ${featureBtn}
                            <button class="btn btn-sm btn-danger deleteRecipeBtn" data-id="${r.recipe_id}">Delete</button>
                        </div>
                    </td>
                </tr>`;
        });

        $("#recipeTable").html(html);
    });
}

$(document).on("click", ".setFeaturedBtn", function () {
    let id = $(this).data("id");

    $.post("../../ajax/set_featured.php", { recipe_id: id }, function (res) {
        let r = JSON.parse(res || "{}");
        if (r.status === "success") loadRecipes();
        else alert("Failed to set featured.");
    });
});

$(document).on("click", ".removeFeaturedBtn", function () {
    let id = $(this).data("id");

    $.post("../../ajax/remove_featured.php", { recipe_id: id }, function (res) {
        let r = JSON.parse(res || "{}");
        if (r.status === "success") loadRecipes();
        else alert("Failed to remove featured.");
    });
});

</script>
<script src="../../assets/js/app.js"></script>
</body>
</html>
