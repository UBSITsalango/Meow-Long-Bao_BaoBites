<?php
require '../../app/auth.php';
requireAdmin();
include '../header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - BaoBites</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<?php include 'admin_sidebar.php'; ?>

<div id="adminMain" class="admin-main">

    <!-- Top bar -->
    <nav class="navbar bg-white shadow-sm topbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Admin Dashboard</h5>
            <small class="text-muted">Signed in as <strong><?= htmlspecialchars($_SESSION['name']) ?></strong></small>
        </div>
    </nav>

    <div class="container py-4">

        <!-- Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm p-4 text-center">
                    <h3 id="statRecipes" class="fw-bold text-orange">0</h3>
                    <p class="text-muted mb-0">Total Recipes</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card shadow-sm p-4 text-center">
                    <h3 id="statUsers" class="fw-bold text-sage">0</h3>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card shadow-sm p-4 text-center">
                    <h3 id="statComments" class="fw-bold text-dark">0</h3>
                    <p class="text-muted mb-0">Total Comments</p>
                </div>
            </div>
        </div>

        <!-- Recent Recipes -->
        <div class="card shadow-sm mb-4 rounded-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Recent Recipes</h5>

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>User</th>
                            <th>Category</th>
                            <th width="140"></th>
                        </tr>
                    </thead>
                    <tbody id="adminRecipeTable"></tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm rounded-4 mb-5">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Users</h5>

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody id="adminUserTable"></tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function () {
    $.get('../../ajax/load_all_recipes.php', function (res) {
        let data = JSON.parse(res || "[]");

        $("#statRecipes").text(data.length);

        let html = "";
        data.forEach(r => {
            html += `
                <tr>
                    <td>${r.title}</td>
                    <td>${r.username}</td>
                    <td><span class="badge bg-success">${r.category}</span></td>
                    <td>
                        <a class="btn btn-primary btn-sm me-2" href="recipe_admin.php?id=${r.recipe_id}">View</a>
                        <button class="btn btn-danger btn-sm deleteRecipeBtn" data-id="${r.recipe_id}">Delete</button>
                    </td>
                </tr>`;
        });

        $("#adminRecipeTable").html(html);
    });

    $.get('../../ajax/load_users.php', function (res) {
        let users = JSON.parse(res || "[]");

        $("#statUsers").text(users.length);

        let html = "";
        users.forEach(u => {
            html += `
                <tr>
                    <td>${u.username}</td>
                    <td>${u.email}</td>
                    <td>${u.created_at}</td>
                    <td width="160">
                        <a href="edit_user.php?id=${u.user_id}" class="btn btn-sm btn-primary me-2">Edit</a>
                        <button class="btn btn-sm btn-danger deleteUserBtn" data-id="${u.user_id}">Delete</button>
                    </td>
                </tr>`;
        });

        $("#adminUserTable").html(html);
    });

    $.get('../../ajax/get_comment_count.php', function (res) {
        let d = JSON.parse(res || "{}");
        $("#statComments").text(d.count || 0);
    });
});
</script>
<script src="../../assets/js/app.js"></script>
</body>
</html>
