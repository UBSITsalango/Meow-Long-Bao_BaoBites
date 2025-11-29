<?php 
session_start();
include 'header.php';

if (isset($_SESSION['user_id'])) include 'navbar.php';
else include 'navbar_guest.php';
?>

<section class="py-5 baobites-hero">
  <div class="container text-center py-4 fade-in-up">
      <h1 class="fw-bold" style="color:#333;">Contact Us</h1>
      <p class="lead mt-3" style="max-width:700px; margin:auto; color:#555;">
          We'd love to hear from you! Whether it's feedback, questions, or suggestions — 
          the BaoBites team is always happy to help.
      </p>
  </div>
</section>

<section class="py-5 fade-in-up delay-1">
  <div class="container" style="max-width:900px;">

    <div class="p-4 p-md-5 rounded shadow-sm" style="background:white; border-radius:20px;">

      <div class="row g-4 align-items-stretch">

          <div class="col-md-6 fade-in-up delay-2">
              <h3 class="fw-bold mb-3" style="color:#E2725B;">Get in Touch</h3>

              <form>
                  <div class="mb-3">
                      <label class="form-label fw-semibold">Full Name</label>
                      <input type="text" class="form-control" required>
                  </div>

                  <div class="mb-3">
                      <label class="form-label fw-semibold">Email Address</label>
                      <input type="email" class="form-control" required>
                  </div>

                  <div class="mb-3">
                      <label class="form-label fw-semibold">Message</label>
                      <textarea class="form-control" rows="5" required></textarea>
                  </div>

                  <button class="btn orange-btn w-100">Send Message</button>
              </form>
          </div>

        <div class="col-md-6 d-flex flex-column justify-content-start fade-in-up delay-3">

            <div class="mb-4">
                <h3 class="fw-bold mb-3" style="color:#A3B18A;">Contact Details</h3>

                <p class="mb-2"><strong>Email:</strong> support@baobites.com</p>
                <p class="mb-2"><strong>Phone:</strong> +63 900 000 0000</p>
                <p class="mb-2"><strong>Address:</strong> Baguio City, Philippines</p>
            </div>

            <div class="d-flex justify-content-center">
                <img src="../assets/images/contact.png"
                    alt="Contact Illustration"
                    style="max-width:40%; border-radius:20px;">
            </div>

        </div>
      </div>

    </div>

  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
