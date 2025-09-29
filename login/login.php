<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaoBites</title>
</head>
<body>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BaoBites - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ff4d6d; /* vibrant pink from logo */
      font-family: 'Poppins', sans-serif;
    }
    .login-card {
      background-color: #fff6e6; /* cream/bao bun color */
      border-radius: 20px;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
      padding: 2rem;
    }
    .btn-custom {
      background-color: #ff914d; /* orange cat color */
      color: white;
      border-radius: 10px;
    }
    .btn-custom:hover {
      background-color: #ff7a29;
    }
    .logo-text {
      color: #fff6e6;
      font-weight: 700;
      font-size: 2rem;
    }
  </style>
</head>
<body>

  <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="text-center mb-4">
      <img src="icon2.png" alt="BaoBites Logo" width="180">
      <h1 class="logo-text mt-2">BaoBites</h1>
    </div>

<div class="login-card col-12 col-md-6 col-lg-4">
  <h3 class="text-center mb-4">Login</h3>
  <form method = "post">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter your password">
    </div>
    <button type="submit" class="btn btn-custom w-100">Login</button>
  </form>
  <p class="text-center mt-3">
    Don’t have an account? <a href="#" class="text-decoration-none text-danger">Sign Up</a>
  </p>
</div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>