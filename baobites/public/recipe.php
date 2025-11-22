<?php 
require '../app/auth.php'; 
requireLogin(); 

$recipe_id = $_GET['id'] ?? null;
if (!$recipe_id) {
    die("Invalid recipe");
}

include 'header.php';
include 'navbar.php';
?>

<body class="cream-bg">

<div class="container py-4">
    <div id="recipeContainer" data-id="<?= htmlspecialchars($recipe_id) ?>"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
$(document).ready(function () {

    const recipeId = $("#recipeContainer").data("id");

    $.get("../ajax/load_recipe.php", { id: recipeId }, function (res) {

        if (res.error) {
            window.location.href = "my_recipes.php";
            return;
        }

        const r = res.recipe;
        const comments = res.comments;
        const rating = res.rating ?? 0;
        const favorite = res.favorite;
        const isOwner = r.user_id == <?= $_SESSION['user_id'] ?>;

        let favClass = favorite ? "active" : "";

        let starsHtml = "";
        for (let i = 1; i <= 5; i++) {
            let selected = i <= Math.round(rating) ? "selected" : "";
            starsHtml += `<span class="star ${selected}" data-score="${i}">★</span>`;
        }

        let html = `
        <div class="card p-4 shadow-sm" style="border-radius:18px;">

            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold" style="color:#E2725B;">${escapeHtml(r.title)}</h2>
                    <p class="text-muted">by <strong>${escapeHtml(r.username)}</strong></p>
                    <span class="badge" style="background:#A3B18A;">${escapeHtml(r.category)}</span>
                </div>

                <div class="text-end">
                    <span class="favorite-heart ${favClass}" 
                          data-id="${r.recipe_id}"
                          style="cursor:pointer;">❤</span>

                    ${isOwner ? `
                        <div class="mt-2">
                            <a href="edit_recipe.php?id=${r.recipe_id}" 
                               class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <button class="btn btn-sm btn-outline-danger deleteRecipeBtn" 
                                    data-id="${r.recipe_id}">
                                Delete
                            </button>
                        </div>
                    ` : ""}
                </div>
            </div>

            <hr>

            <h5 class="mt-3 mb-1">Rating</h5>
            <div class="rating-box">${starsHtml}
                <span class="ms-2 text-muted">(${rating})</span>
            </div>

            <hr>

            <h4 class="fw-bold">Ingredients</h4>
            <pre style="white-space:pre-wrap;">${escapeHtml(r.ingredients)}</pre>

            <hr>

            <h4 class="fw-bold">Instructions</h4>
            <pre style="white-space:pre-wrap;">${escapeHtml(r.instructions)}</pre>

            <hr>

            <h4 class="fw-bold mb-3">Comments</h4>
            <div id="commentList">
                ${comments.length === 0 ? "<p class='text-muted'>No comments yet.</p>" : ""}
                ${comments.map(c => `
                    <div class="p-3 mb-2 rounded" style="background:#FFF4E0;">
                        <strong>${escapeHtml(c.username)}</strong>
                        <p class="mb-1">${escapeHtml(c.content)}</p>
                        <small class="text-muted">${c.created_at}</small>
                    </div>
                `).join('')}
            </div>

            <form id="commentForm" class="mt-3">
                <textarea name="content" class="form-control mb-2" 
                          placeholder="Write a comment..." required></textarea>
                <input type="hidden" name="recipe_id" value="${r.recipe_id}">
                <button class="btn orange-btn">Post Comment</button>
            </form>

        </div>
        `;

        $("#recipeContainer").html(html);

    }, "json");
});

$(document).on("click", ".favorite-heart", function () {
    let btn = $(this);
    let recipeId = btn.data("id");

    $.post("../ajax/toggle_favorite.php", { recipe_id: recipeId }, function () {
        btn.toggleClass("active");
    });
});

$(document).on("click", ".star", function () {
    let score = $(this).data("score");
    let recipeId = $("#recipeContainer").data("id");

    $.post("../ajax/add_rating.php", { recipe_id: recipeId, score: score }, function () {
        location.reload();
    });
});

$(document).on("submit", "#commentForm", function (e) {
    e.preventDefault();

    $.post("../ajax/add_comment.php", $(this).serialize(), function () {
        location.reload();
    });
});
</script>
</body>
</html>
