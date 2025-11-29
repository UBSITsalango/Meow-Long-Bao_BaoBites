<?php 
session_start();
include 'header.php';

if (isset($_SESSION['user_id'])) include 'navbar.php';
else include 'navbar_guest.php';
?>

<section class="py-5 baobites-hero">
  <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between py-5">

      <div class="text-center text-md-start fade-in-up">
          <h1 class="fw-bold mb-3" style="color:#333; font-size:2.8rem;">Welcome to<br>BaoBites</h1>
          <p class="lead mb-4" style="color:#555; max-width:400px;">
              Discover, share, and savor delicious recipes from our community
          </p>

          <a href="register.php" class="btn me-2 orange-btn"
             style="border-radius:25px; padding:10px 20px;">
              Join Our Community
          </a>

          <a href="#featured" class="btn"
             style="border:2px solid #E2725B; color:#E2725B;
                    border-radius:25px; padding:10px 20px;">
             Explore Recipes
          </a>
      </div>

      <div class="d-none d-md-block fade-in-up delay-1">
          <img src="../assets/images/cookie.png" class="hero-cookie">
      </div>

  </div>
</section>

<section id="featured" class="py-5 bb-white fade-in-up delay-2">
  <div class="container">
      <h2 class="fw-bold" style="color:#333;">Featured Recipes</h2>
      <p class="mb-4 text-muted">Handpicked favorites from our community</p>

      <div id="featuredRecipes" class="row g-4 justify-content-center"></div>
  </div>
</section>

<section class="py-5 fade-in-up delay-3" style="background:#A3B18A; color:white;">
  <div class="container text-center">
      <h2 class="fw-bold mb-4">Join Our Cooking Community</h2>
      <p class="mb-5" style="color:#f1f1f1;">
          Share your favorite recipes and discover new culinary adventures
      </p>

      <div class="row g-4 justify-content-center">

          <div class="col-md-3">
              <h1>👨‍🍳</h1>
              <h3 id="statUsers">0</h3>
              <p>Active Cooks</p>
          </div>

          <div class="col-md-3">
              <h1>🍽️</h1>
              <h3 id="statRecipes">0</h3>
              <p>Shared Recipes</p>
          </div>

          <div class="col-md-3">
              <h1>❤️</h1>
              <h3 id="statFavs">0</h3>
              <p>Recipe Likes</p>
          </div>

      </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/app.js"></script>

<script>
$(function () {

    $.get('../ajax/load_featured.php', function(res) {
        let list = jsonSafeParse(res) || [];
        let html = "";

        if (!list.length) {
            $("#featuredRecipes").html("<p class='text-muted'>No featured recipes yet.</p>");
            return;
        }

        list.forEach(r => {
            html += `
            <div class="col-md-4 col-sm-6 fade-in-up delay-1">
                <div class="card shadow-sm recipe-card" style="border-radius:18px; overflow:hidden;">

                    <div style="background:#A3B18A; height:130px; 
                                display:flex; align-items:center; justify-content:center; 
                                color:white; font-size:3rem;">
                        🍲
                    </div>

                    <div class="card-body">
                        <h5 class="fw-bold" style="color:#333;">${r.title}</h5>
                        <span class="badge" style="background:#E2725B;">${r.category}</span>
                        <p class="text-muted mt-1 mb-2" style="font-size:0.9rem;">by ${r.username}</p>

                        <a href="recipe.php?id=${r.recipe_id}"
                           class="btn orange-btn btn-sm fw-semibold"
                           style="border-radius:18px;">
                           View Recipe
                        </a>
                    </div>

                </div>
            </div>`;
        });

        $("#featuredRecipes").html(html);
    });

    $.get('../ajax/get_stats.php', function(res) {
        let stats = jsonSafeParse(res) || {};

        $("#statUsers").text(stats.users || 0);
        $("#statRecipes").text(stats.recipes || 0);
        $("#statFavs").text(stats.favorites || 0);
    });

});
</script>
</body>
</html>
