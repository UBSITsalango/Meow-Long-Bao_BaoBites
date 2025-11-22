<?php
require '../../app/auth.php';
requireAdmin();
include '../header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - BaoBites</title>

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
            <h5 class="fw-bold mb-0">Manage Users</h5>
        </div>
    </nav>

    <div class="container py-4">

        <div class="card shadow-sm rounded-4">
            <div class="card-body">

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th width="160"></th>
                        </tr>
                    </thead>
                    <tbody id="userTable"></tbody>
                </table>

            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $.get('../../ajax/load_users.php', function (res) {
        let users = JSON.parse(res || "[]");

        let html = "";
        users.forEach(u => {
            html += `
                <tr>
                    <td>${u.username}</td>
                    <td>${u.email}</td>
                    <td>${u.created_at}</td>
                    <td>
                        <a href="edit_user.php?id=${u.user_id}" class="btn btn-sm btn-primary me-2">Edit</a>
                        <button class="btn btn-sm btn-danger deleteUserBtn" data-id="${u.user_id}">
                            Delete
                        </button>
                    </td>
                </tr>`;
        });

        $("#userTable").html(html);
    });
});
</script>
<script src="../../assets/js/app.js"></script>
</body>
</html>
