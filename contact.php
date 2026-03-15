<?php

include "db.php";

$success_message = $error_message = "";


if (isset($_POST['btn'])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $message = $_POST["message"];


      $sql = "INSERT INTO tbl_contact (username, email, message) 
              VALUES ('$username', '$email', '$message')";

      if($conn->query($sql)){
        $success_message = "Message Sent";
    }else{
        $error_message = "Registration Failed";
     }
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Contact</title>
</head>

<body class="backgrounddd">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container-fluid px-5">

      <a class="navbar-brand fw-bold" href="#">LUTONG INA MO</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-4 me-3">
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="landing.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="login.php">Log in</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  <!--contacttt-->
  <div class="contact-wrapper">
    <div class="contact-box">

      <h2 class="text-center fw-bold mb-4">Contact Us</h2>

      <div class="row g-4">

        <div class="col-md-6">
          <h4 class="fw-semibold">Our Contact Info</h4>
          <p>📍 Address: Ph2 Blk 67 Lot 5 Brgy. Timbao, Binan, Laguna, Philippines</p>
          <p>📧 Email: lutonginamo@gmail.com</p>
          <p>📞 Phone: 0912-345-6789</p>

          <div class="mt-4">
            <iframe src="https://www.google.com/maps?q=Brgy.+Timbao,+Biñan,+Laguna,+Philippines&output=embed"
              width="100%" height="300" style="border:0; border-radius:15px;" allowfullscreen="" loading="lazy">
            </iframe>
          </div>


        </div>


        <div class="col-md-6">

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

            <?php if($success_message != ""): ?>
           <div class="alert alert-success"><?php echo $success_message; ?></div>
           <?php endif; ?>
            
          <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="username" class="form-control" placeholder="Your name" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Your email" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Message</label>
              <input type="email" name="message" class="form-control" placeholder="Write Your Message" required>
            </div>

            <button type="submit" name="btn" class="btn btn-warning w-100 fw-semibold">Send Message</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
      <div class="row gy-4">

        <!-- Brand -->
        <div class="col-lg-4">
          <h5 class="fw-bold">LUTONG INA MO</h5>
          <p class="text-white-50 mb-0">
            Malasa na, medyo masarap pa. Tara kain!
          </p>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-4">
          <h6 class="fw-bold mb-3">Quick Links</h6>
          <ul class="list-unstyled">
            <li><a href="landing.html" class="text-decoration-none text-white-50">Home</a></li>
            <li><a href="about.html" class="text-decoration-none text-white-50">About</a></li>
            <li><a href="contact.html" class="text-decoration-none text-white-50">Contact Us</a></li>
            <li><a href="login.html" class="text-decoration-none text-white-50">Log in</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div class="col-lg-4">
          <h6 class="fw-bold mb-3">Contact</h6>
          <p class="mb-1 text-white-50">📍 Address: Ph2 Blk 67 Lot 5 Brgy. Timbao, Binan, Laguna, Philippines</p>
          <p class="mb-1 text-white-50">📞 0912-345-6789</p>
          <p class="mb-0 text-white-50">✉️ lutonginamo@email.com</p>
        </div>

      </div>
  </footer>








  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>