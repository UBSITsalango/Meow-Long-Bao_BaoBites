<?php 
session_start(); 

// Prevent logged-in users from accessing this page
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

include 'header.php'; 
?>

<?php include 'navbar_guest.php'; ?>

<main>

<section class="py-5 baobites-hero fade-in-up">
    <div class="container text-center">
        <h1 class="fw-bold" style="color:#333;">Join BaoBites</h1>
        <p class="lead mt-2" style="color:#555;">
            Create an account to share and explore delicious recipes
        </p>
    </div>
</section>

<div class="container my-5" style="max-width: 450px;">
    <div class="p-4 p-md-5 rounded shadow-sm bg-white fade-in-up delay-1"
         style="border-radius:20px;">

        <h3 class="fw-bold mb-3" style="color:#E2725B;">Create Account</h3>
        <div id="regMsg" class="alert d-none"></div>

        <form id="regForm">

            <div class="row g-2">
                <div class="col-md-6 mb-2">
                    <label class="form-label fw-semibold">First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label fw-semibold">Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn orange-btn w-100 py-2 fw-semibold">Create Account</button>

            <div class="text-center mt-3">
                <a href="login.php" class="text-decoration-none" style="color:#E2725B;">
                    Already have an account? Login
                </a>
            </div>

            <div class="text-center mt-2">
                <a href="index.php" class="text-decoration-none">← Back to Home</a>
            </div>

        </form>

    </div>
</div>

</main>

<?php include 'footer.php'; ?>
</body>
</html>
