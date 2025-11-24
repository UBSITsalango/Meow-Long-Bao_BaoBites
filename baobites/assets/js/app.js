const BASE_URL = "/Meow-Long-Bao_BaoBites/baobites";

/* Helpers */
function jsonSafeParse(t) { try { return JSON.parse(t); } catch { return null; } }
function escapeHtml(s) {
    return String(s)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}
function alertBox(id, msg, type = "danger") {
    const el = $(id);
    el.removeClass("d-none alert-danger alert-success")
      .addClass("alert-" + type)
      .text(msg);
}

/* AUTH */

/* Login */
$(document).on("submit", "#loginForm", function (e) {
    e.preventDefault();

    $.post(BASE_URL + "/ajax/login.php", $(this).serialize(), function (res) {
        let r = jsonSafeParse(res);

        if (r?.status === "success") {
            if (r.role === "admin") location = BASE_URL + "/public/admin/admin.php";
            else location = "dashboard.php";
        } else {
            alertBox("#loginMsg", r?.msg || "Login failed.");
        }
    });
});

/* Register */
$(document).on("submit", "#regForm", function (e) {
    e.preventDefault();

    $.post(BASE_URL + "/ajax/register.php", $(this).serialize(), function (res) {
        let r = jsonSafeParse(res);

        if (r?.status === "success") location = "login.php";
        else alertBox("#regMsg", r?.msg || "Registration failed.");
    });
});


/* RECIPE CRUD */

/* Add Recipe */
$(document).on("submit", "#addRecipeForm", function (e) {
    e.preventDefault();

    $.post(BASE_URL + "/ajax/add_recipe.php", $(this).serialize(), function (res) {
        let r = jsonSafeParse(res);

        if (r?.status === "success") location = "dashboard.php";
        else alert("Unable to add recipe.");
    });
});

/* Edit Recipe */
$(document).on("submit", "#editRecipeForm", function (e) {
    e.preventDefault();

    $.post(BASE_URL + "/ajax/update_recipe.php", $(this).serialize(), function (res) {
        let r = jsonSafeParse(res);

        if (r?.status === "success") location = "my_recipes.php";
        else alertBox("#editRecipeMsg", r?.msg || "Update failed.");
    });
});

/* Delete Recipe (global handler) */
$(document).on("click", ".deleteRecipeBtn", function () {
    const id = $(this).data("id");
    if (!confirm("Delete this recipe?")) return;

    $.post(BASE_URL + "/ajax/delete_recipe.php", { recipe_id: id }, function (res) {
        let r = jsonSafeParse(res);

        if (r?.status === "success") location.reload();
        else alert(r?.msg || "Delete failed.");
    }).fail(() => {
        alert("Server error.");
    });
});

/* DELETE USER (GLOBAL HANDLER) */

$(document).on("click", ".deleteUserBtn", function () {
    const id = $(this).data("id");

    if (!confirm("Permanently delete this user?")) return;

    $.post(BASE_URL + "/ajax/delete_user.php", { user_id: id }, function (res) {
        let r = jsonSafeParse(res);

        if (r?.status === "success") {
            location.reload();
        } else {
            alert(r?.msg || "Delete failed.");
        }
    }).fail(() => alert("Server error."));
});

/* LOAD ALL RECIPES */

let allRecipes = [];

function loadAllRecipes(cb) {
    $.get(BASE_URL + "/ajax/load_all_recipes.php", function (res) {
        allRecipes = jsonSafeParse(res) || [];
        if (cb) cb();
    });
}

/* LOAD USERS (NEW FUNCTION) */

function loadUsers(cb) {
    $.get(BASE_URL + "/ajax/load_users.php", function (res) {
        let users = jsonSafeParse(res) || [];
        if (cb) cb(users);
    });
}

/* MY RECIPES PAGE */

if ($("#myRecipeList").length) {

    $.get(BASE_URL + "/ajax/load_my_recipes.php", function (raw) {
        let list = jsonSafeParse(raw) || [];
        let html = "";

        if (list.length === 0) {
            $("#emptyMyRecipes").removeClass("d-none");
            return;
        }

        list.forEach(x => {
            html += `
                <div class="col-md-4 col-sm-6 recipe-card">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <h5 class="fw-bold" style="color:var(--orange)">
                                ${escapeHtml(x.title)}
                            </h5>

                            <a href="recipe.php?id=${x.recipe_id}" class="btn orange-btn btn-sm">View</a>
                            <a href="edit_recipe.php?id=${x.recipe_id}" class="btn btn-sm btn-outline-secondary ms-2">Edit</a>

                            <button class="btn btn-sm btn-danger ms-2 deleteRecipeBtn"
                                    data-id="${x.recipe_id}">
                                Delete
                            </button>

                        </div>
                    </div>
                </div>`;
        });

        $("#myRecipeList").html(html);
    });
}

/* RECIPE PAGE */

if ($("#recipeContainer").length) {
    let id = $("#recipeContainer").data("id");

    $.get(BASE_URL + "/ajax/load_recipe.php?id=" + id, function (raw) {
        let d = jsonSafeParse(raw);
        if (!d?.recipe) {
            $("#recipeContainer").html("<div class='alert alert-danger'>Recipe not found.</div>");
            return;
        }
        renderRecipePage(d);
    });

    function renderRecipePage(d) {
        let r = d.recipe;

        let commentsHTML = d.comments.map(c => `
            <div class="p-3 mb-3 bg-white rounded">
                <strong>${escapeHtml(c.username)}</strong>
                <p>${escapeHtml(c.content)}</p>
                <small class="text-muted">${c.created_at}</small>
            </div>
        `).join("");

        $("#recipeContainer").html(`
        <div class='p-4 bg-white rounded shadow-sm'>
            <h2 class='fw-bold' style='color:var(--orange)'>${escapeHtml(r.title)}</h2>
            <span class='badge' style='background:var(--sage)'>${escapeHtml(r.category)}</span>
            <p class='text-muted mt-2'>by ${escapeHtml(r.username)}</p>

            <div id='favoriteBtn' class='favorite-heart ${d.favorite ? "active" : ""}'>❤</div>

            <h4 class='mt-4'>Ingredients</h4>
            <pre>${escapeHtml(r.ingredients)}</pre>

            <h4 class='mt-4'>Instructions</h4>
            <pre>${escapeHtml(r.instructions)}</pre>

            <h4 class='mt-4'>Rating</h4>
            <div id='ratingBox'>
                ${[1,2,3,4,5].map(n =>
                    `<span class='star ${d.rating >= n ? "selected" : ""}' data-val='${n}'>★</span>`
                ).join("")}
            </div>

            <h4 class='mt-4'>Leave Comment</h4>
            <form id='commentForm'>
                <textarea name='content' class='form-control mb-2' required></textarea>
                <input type='hidden' name='recipe_id' value='${r.recipe_id}' />
                <button class='btn orange-btn btn-sm'>Post</button>
            </form>

            <h4 class='mt-4'>Comments</h4>
            <div id='commentSection'>${commentsHTML}</div>
        </div>`);
    }
}

/* Post Comment */
$(document).on("submit", "#commentForm", function (e) {
    e.preventDefault();
    $.post(BASE_URL + "/ajax/add_comment.php", $(this).serialize(), () => location.reload());
});

/* Rating */
$(document).on("click", ".star", function () {
    if ($(this).css("cursor") === "not-allowed" || $(this).css("cursor") === "default") {
        return; // owner or guest
    }
    let score = $(this).data("val") || $(this).data("score");
    let id = $("#recipeContainer").data("id");
    $.post(BASE_URL + "/ajax/add_rating.php", { score, recipe_id: id }, () => location.reload());
});

/* Favorite */
$(document).on("click", "#favoriteBtn", function () {
    let id = $("#recipeContainer").data("id");
    $.post(BASE_URL + "/ajax/toggle_favorite.php", { recipe_id: id }, function (res) {
        let r = jsonSafeParse(res);
        $("#favoriteBtn").toggleClass("active", r?.status === "added");
    });
});
