<?php 
session_start();
include 'header.php';

// Show correct navbar
if (isset($_SESSION['user_id'])) include 'navbar.php';
else include 'navbar_guest.php';

// Recipe ID check
$recipe_id = $_GET['id'] ?? null;
if (!$recipe_id) {
    die("Invalid recipe");
}
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
    const isGuest = <?= isset($_SESSION['user_id']) ? 'false' : 'true' ?>;

    $.get("../ajax/load_recipe.php", { id: recipeId }, function (res) {

        if (res.error) {
            window.location.href = "dashboard.php";
            return;
        }

        const r = res.recipe;
        const comments = res.comments;
        const rating = res.rating ?? 0;
        const favorite = res.favorite;
        const isOwner = <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0' ?> == r.user_id;

        let favClass = favorite ? "active" : "";

        // ⭐ Build stars
        let starsHtml = "";
        for (let i = 1; i <= 5; i++) {
            let selected = i <= Math.round(rating) ? "selected" : "";

            // Guest → no clicking
            if (isGuest) {
                starsHtml += `
                    <span class="star ${selected}" style="cursor:default; opacity:0.6;">★</span>
                `;
            }
            // Owner → see stars but cannot click
            else if (isOwner) {
                starsHtml += `
                    <span class="star ${selected}" style="cursor:not-allowed; opacity:0.5;">★</span>
                `;
            }
            // Normal logged-in user → clickable stars
            else {
                starsHtml += `
                    <span class="star ${selected}" data-score="${i}" style="cursor:pointer;">★</span>
                `;
            }
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

                    ${isGuest ? "" : `
                    <span class="favorite-heart ${favClass}" data-id="${r.recipe_id}" style="cursor:pointer;">❤</span>
                    `}

                    ${isOwner && !isGuest ? `
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
            <div class="rating-box">
                ${starsHtml}
                <span class="ms-2 text-muted">(${rating})</span>
            </div>

            ${isGuest ? `
                <p class="text-muted mt-1">Login to rate recipes.</p>
            ` : ""}

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

            ${isGuest ? `
                <p class="text-muted mt-3">Login to leave a comment.</p>
            ` : `
            <form id="commentForm" class="mt-3">
                <textarea name="content" class="form-control mb-2" 
                          placeholder="Write a comment..." required></textarea>
                <input type="hidden" name="recipe_id" value="${r.recipe_id}">
                <button class="btn orange-btn">Post Comment</button>
            </form>
            `}
        </div>
        `;

        $("#recipeContainer").html(html);

    }, "json");
});

// ❤️ Favorite
$(document).on("click", ".favorite-heart", function () {
    const isGuest = <?= isset($_SESSION['user_id']) ? 'false' : 'true' ?>;
    if (isGuest) return alert("Login to save favorites.");

    let btn = $(this);
    let recipeId = btn.data("id");

    $.post("../ajax/toggle_favorite.php", { recipe_id: recipeId }, function () {
        btn.toggleClass("active");
    });
});

// ⭐ Rating
$(document).on("click", ".star", function () {
    const isGuest = <?= isset($_SESSION['user_id']) ? 'false' : 'true' ?>;
    if (isGuest) return alert("Login to rate recipes.");

    let score = $(this).data("score");
    let recipeId = $("#recipeContainer").data("id");

    $.post("../ajax/add_rating.php", { recipe_id: recipeId, score: score }, function () {
        location.reload();
    });
});

// 💬 Comment
$(document).on("submit", "#commentForm", function (e) {
    e.preventDefault();

    $.post("../ajax/add_comment.php", $(this).serialize(), function () {
        location.reload();
    });
});
</script>

</body>
</html>
