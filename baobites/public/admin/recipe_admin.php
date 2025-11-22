<?php
require '../../app/auth.php';
requireAdmin();

include '../header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin View Recipe - BaoBites</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<?php include 'admin_sidebar.php'; ?>

<div id="adminMain" class="admin-main">

    <nav class="navbar bg-white shadow-sm topbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">View Recipe (Admin)</h5>
            <a href="manage_recipes.php" class="btn btn-secondary btn-sm">Back</a>
        </div>
    </nav>

    <div class="container py-4">

        <div id="recipeArea"></div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const id = new URLSearchParams(window.location.search).get("id");

$(document).ready(function () {

    $.get("../../ajax/load_recipe.php?id=" + id, function (raw) {
        let d = null;
        try { d = JSON.parse(raw); } catch { d = null; }

        if (!d || !d.recipe) {
            window.location.href = "manage_recipes.php";
            return;
        }

        renderRecipe(d);
    });
});

function renderRecipe(d) {

    const r = d.recipe;

    let commentsHTML = d.comments.map(c => `
        <div class="p-3 mb-3 bg-white rounded shadow-sm">
            <strong>${escapeHtml(c.username)}</strong>
            <p class="mb-1">${escapeHtml(c.content)}</p>
            <small class="text-muted">${c.created_at}</small>
        </div>
    `).join("");

    $("#recipeArea").html(`
        <div class="card shadow-sm p-4 rounded-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold text-orange mb-0">${escapeHtml(r.title)}</h2>

                <button class="btn btn-danger deleteRecipeBtn" data-id="${r.recipe_id}">
                    <i class="bi bi-trash me-1"></i> Delete
                </button>
            </div>

            <p class="mb-1 text-muted">
                <strong>Author:</strong> ${escapeHtml(r.username)}
            </p>

            <p class="mb-3">
                <span class="badge bg-success">${escapeHtml(r.category)}</span>
            </p>

            <hr>

            <h4 class="fw-semibold mt-3">Ingredients</h4>
            <pre class="bg-light p-3 rounded">${escapeHtml(r.ingredients)}</pre>

            <h4 class="fw-semibold mt-3">Instructions</h4>
            <pre class="bg-light p-3 rounded">${escapeHtml(r.instructions)}</pre>

            <h4 class="fw-semibold mt-4">Rating</h4>
            <p class="mb-3">
                ${renderStars(d.rating)}
                <span class="ms-2 text-muted">${d.rating || 0}/5</span>
            </p>

            <h4 class="fw-semibold mt-4">Comments</h4>
            <div>${commentsHTML || "<p class='text-muted'>No comments yet.</p>"}</div>
        </div>
    `);
}

function renderStars(score) {
    let s = "";
    for (let i = 1; i <= 5; i++) {
        s += `<i class="bi bi-star${i <= score ? '-fill' : ''}" 
               style="color:#E2725B; font-size:22px;"></i>`;
    }
    return s;
}

function escapeHtml(text) {
    return String(text || "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}
</script>
<script src="../../assets/js/app.js"></script>
</body>
</html>
