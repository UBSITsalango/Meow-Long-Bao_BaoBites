<?php 
require '../app/auth.php'; 
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Recipe - BaoBites</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="cream-bg">

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<main>
<div class="container mt-4" style="max-width:700px;" 
     id="editContainer" 
     data-id="<?= htmlspecialchars($_GET['id'] ?? '') ?>">

    <h2 class="fw-bold" style="color:#A3B18A;">Edit Recipe</h2>
    <div id="editRecipeMsg" class="alert d-none mt-3"></div>

    <form id="editRecipeForm" 
          class="p-4 rounded shadow-sm mt-3" 
          style="background:white;">

        <input type="hidden" name="recipe_id" id="edit_id">

        <label class="fw-semibold">Title</label>
        <input type="text" name="title" id="edit_title" class="form-control mb-3" required>

        <label class="fw-semibold">Ingredients</label>
        <textarea name="ingredients" id="edit_ing" rows="5" class="form-control mb-3" required></textarea>

        <label class="fw-semibold">Instructions</label>
        <textarea name="instructions" id="edit_ins" rows="5" class="form-control mb-3" required></textarea>

        <label class="fw-semibold">Category</label>
        <select name="category" id="edit_cat" class="form-select mb-4">
            <option>Main Dish</option>
            <option>Dessert</option>
            <option>Snack</option>
            <option>Beverage</option>
            <option>Other</option>
        </select>

        <div class="d-flex gap-2">
            <button class="btn orange-btn w-100" type="submit">Save Changes</button>
            <a href="recipe.php?id=<?= htmlspecialchars($_GET['id'] ?? '') ?>" 
               class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
</main>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
$(document).ready(function () {
    const id = $("#editContainer").data("id");
    const $msg = $("#editRecipeMsg");

    if (!id) {
        $msg.removeClass("d-none alert-success")
            .addClass("alert-danger")
            .text("Invalid recipe ID.");
        return;
    }

    $.get("../ajax/load_recipe.php?id=" + id, function (raw) {
        const res = typeof raw === "object" ? raw : JSON.parse(raw);

        if (!res.recipe) {
            $msg.removeClass("d-none alert-success")
                .addClass("alert-danger")
                .text("Recipe not found or access denied.");
            return;
        }

        const r = res.recipe;

        $("#edit_id").val(r.recipe_id);
        $("#edit_title").val(r.title);
        $("#edit_ing").val(r.ingredients);
        $("#edit_ins").val(r.instructions);
        $("#edit_cat").val(r.category);

    }).fail(function () {
        $msg.removeClass("d-none alert-success")
            .addClass("alert-danger")
            .text("Failed to load recipe.");
    });
});
</script>
</body>
</html>
