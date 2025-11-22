<?php 
session_start();
include 'header.php';
include 'navbar_guest.php';
?>

<section class="baobites-hero py-5">
  <div class="container text-center py-5">
      <h1 class="fw-bold fade-in-up">About BaoBites</h1>
      <p class="lead mt-3 fade-in-up delay-1" style="max-width:700px; margin:auto;">
          BaoBites is a warm, community-driven recipe-sharing platform created by Team Meow Long Bao.
          Our mission is to bring people together through food, creativity, and culture.
      </p>
  </div>
</section>

<section class="py-5 section-light">
  <div class="container" style="max-width:900px;">
      <div class="mb-5 text-center fade-in-up">
          <h2 class="fw-bold section-title-orange">Our Story</h2>
          <p class="mt-3">
              BaoBites began as an academic project, but quickly grew into a passion-filled platform inspired
              by cozy kitchens, homemade dishes, and the joy of discovering new flavors.
          </p>
      </div>

      <div class="mb-5 text-center fade-in-up delay-1">
          <h2 class="fw-bold section-title-green">What We Offer</h2>
          <p class="mt-3">
              Browse diverse recipes, share your culinary creations, interact through comments and ratings,
              and save your favorites — all through a warm, modern interface built for food lovers.
          </p>
      </div>

      <div class="text-center mb-4 fade-in-up delay-2">
          <h2 class="fw-bold team-title">Meet the Team</h2>
          <p class="mt-3">The passionate individuals behind BaoBites</p>
      </div>

      <div id="teamCarousel" class="carousel slide carousel-fade fade-in-up delay-3" 
           data-bs-ride="carousel" data-bs-interval="3500" data-bs-pause="hover">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#teamCarousel" class="active" data-bs-slide-to="0"></button>
            <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">

            <div class="carousel-item active text-center">
                <img src="../assets/images/team1.jpg" class="team-photo rounded-circle shadow-lg">
                <h4 class="mt-3 fw-bold team-name">Member Name 1</h4>
                <p class="team-role">Role / Title</p>
            </div>

            <div class="carousel-item text-center">
                <img src="../assets/images/team2.jpg" class="team-photo rounded-circle shadow-lg">
                <h4 class="mt-3 fw-bold team-name">Member Name 2</h4>
                <p class="team-role">Role / Title</p>
            </div>

            <div class="carousel-item text-center">
                <img src="../assets/images/team3.jpg" class="team-photo rounded-circle shadow-lg">
                <h4 class="mt-3 fw-bold team-name">Member Name 3</h4>
                <p class="team-role">Role / Title</p>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
      </div>

      <p class="fw-semibold text-center mt-4 fade-in-up delay-4 signature">
          Created with ❤️ by Team Meow Long Bao
      </p>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
