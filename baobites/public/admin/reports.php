<?php
require '../../app/auth.php';
requireAdmin();
include '../header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports - BaoBites</title>

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
            <h5 class="fw-bold mb-0">Reports</h5>
        </div>
    </nav>

    <div class="container py-4">

        <div class="card shadow-sm rounded-4 p-4">
            <h4 class="fw-bold mb-3">Platform Summary</h4>

            <div id="reportsData">

                <p><strong>Total Recipes:</strong> <span id="repRecipes">0</span></p>
                <p><strong>Total Users:</strong> <span id="repUsers">0</span></p>
                <p><strong>Total Comments:</strong> <span id="repComments">0</span></p>

            </div>

        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function () {

    $.get('../../ajax/get_stats.php', res => {
        let stats = JSON.parse(res || "{}");
        $("#repRecipes").text(stats.recipes || 0);
        $("#repUsers").text(stats.users || 0);
        $("#repComments").text(stats.comments || 0);
    });

});
</script>
</body>
</html>
