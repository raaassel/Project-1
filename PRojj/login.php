<?php
session_start();
include "db.php";

$success_message = $error_message = "";

if (isset($_POST['btn'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM tbl_signup WHERE email = '$email'";
    
    $result = $conn->query($sql);

     if($result->num_rows > 0){
        $user = $result->fetch_assoc();
  
      if(password_verify($password, $user['password'])){
        $_SESSION ['user'] = $user['username'];
        $_SESSION ['email'] = $user['email'];
        $_SESSION ['id'] = $user['id'];
        header("Location: dash.php");
        exit();
      }else{
        $error_message = "Invalid Password!!";

      }
    } else {
      $error_message = "Login Failed!";
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body class="backgrounddd">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container-fluid px-5">

      <a class="navbar-brand fw-bold" href="#">LUTONG INA MO</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
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
  

  <!-- Log in -->
  <div class="login-wrapper">
  <div class="login-box">

    <?php if(isset($_SESSION['success_message'])): ?>
    <div id="successAlert" class="alert alert-success">
        <?php 
            echo $_SESSION['success_message'];
            unset($_SESSION['success_message']);
        ?>
    </div>
    <?php endif; ?>

    <?php if($error_message != ""): ?>
           <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    

    <h4 class="text-center mb-4">Login</h4>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="POST" >
      <div class="input-group mb-3">
      <input type="text" name="email" class="form-control" placeholder="email" value="<?= $_POST['email'] ?? '' ?>" required>
      <span class="input-group-text">
       <img src="user.png" style="height: 18px;">
      </span>
      </div>
      <div class="input-group mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $_POST['password'] ?? '' ?>" required>
      <span class="input-group-text">
       <img src="padlock.png" style="height: 18px;">
       </span>
      </div>

      <button type="submit" name="btn" class="btn btn-primary w-100">Login</button>
    </form>

    <p class="text-center mt-3 mb-0">
      Don't have an account? <a href="signup.php">Sign Up</a>
    </p>

  </div>
  </div>
     



 



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
