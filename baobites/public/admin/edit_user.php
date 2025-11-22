<?php
require '../../app/auth.php';
requireAdmin();
require '../../app/db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid user");

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) die("User not found");

include '../header.php';
include 'admin_sidebar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<div id="adminMain" class="admin-main">

    <nav class="navbar bg-white shadow-sm topbar">
        <div class="container-fluid d-flex justify-content-between">
            <h5 class="fw-bold mb-0">Edit User</h5>
            <a href="manage_users.php" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>
    </nav>

    <div class="container py-4">

        <div class="card shadow-sm rounded-4 p-4" style="max-width:600px;margin:auto;">
            <form id="editUserForm">

                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

                <label class="fw-semibold">Username</label>
                <input type="text" class="form-control mb-3" name="username" value="<?= $user['username'] ?>">

                <label class="fw-semibold">Email</label>
                <input type="email" class="form-control mb-3" name="email" value="<?= $user['email'] ?>">

                <label class="fw-semibold">Role</label>
                <select name="role" class="form-select mb-4">
                    <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
                    <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
                </select>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary w-50">Save Changes</button>
                    <a href="manage_users.php" class="btn btn-secondary w-50">Cancel</a>
                </div>
            </form>

            <div id="editUserMsg" class="alert d-none mt-3"></div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$("#editUserForm").submit(function(e){
    e.preventDefault();

    $.post("../../ajax/update_user.php", $(this).serialize(), function(res){
        let r = JSON.parse(res || "{}");

        if (r.status === "success") {
            $("#editUserMsg")
                .removeClass("d-none alert-danger")
                .addClass("alert-success")
                .text("User updated successfully! Redirecting...");

            setTimeout(() => {
                window.location.href = "manage_users.php";
            }, 1000);

        } else {
            $("#editUserMsg")
                .removeClass("d-none alert-success")
                .addClass("alert-danger")
                .text(r.msg || "Update failed.");
        }
    });
});
</script>

</body>
</html>
