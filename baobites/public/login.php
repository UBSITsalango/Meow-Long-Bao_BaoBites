<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - BaoBites</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<?php include 'header.php'; ?>
<body class="cream-bg">

<?php include 'navbar_guest.php'; ?>

<section class="py-5 baobites-hero">
    <div class="container text-center">
        <h1 class="fw-bold" style="color:#333;">Welcome Back</h1>
        <p class="lead mt-2" style="color:#555;">Log in to continue your cooking journey</p>
    </div>
</section>

<div class="container my-5" style="max-width: 450px;">
    <div class="p-4 p-md-5 rounded shadow-sm bg-white"
         style="border-radius:20px; animation: fadeUp 0.5s ease;">
         
        <h3 class="fw-bold mb-3" style="color:#E2725B;">Login</h3>
        <div id="loginMsg" class="alert d-none"></div>

        <form id="loginForm">
            <div class="mb-3">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control" 
                       placeholder="Enter your username" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" 
                       placeholder="Enter your password" required>
            </div>

            <button class="btn orange-btn w-100 py-2 fw-semibold">Log In</button>

            <div class="text-center mt-3">
                <a href="register.php" class="text-decoration-none" style="color:#E2725B;">
                    Don't have an account? Register
                </a>
            </div>

            <div class="text-center mt-2">
                <a href="index.php" class="text-decoration-none">← Back to Home</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

</body>
</html>
