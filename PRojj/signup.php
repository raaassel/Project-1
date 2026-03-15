<?php 
session_start();
include "db.php";

$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conpassword = $_POST["conpassword"];
    $gender = $_POST["gender"];

    // REQUIRED FIELDS CHECK
    if(empty($username) || empty($email) || empty($password) || empty($conpassword) || empty($gender)){
        $_SESSION['error'] = "All fields are required.";

    // PASSWORD MATCH CHECK
    } elseif($password !== $conpassword){
        $_SESSION['error'] = "Password does not match.";

    } else {

        // CHECK IF EMAIL EXISTS
        $checkEmail = "SELECT * FROM tbl_signup WHERE email='$email'";
        $result = $conn->query($checkEmail);

        if($result->num_rows > 0){
            $_SESSION['error'] = "Email already registered!";
        } else {

            // HASH PASSWORD
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // INSERT USER
            $sql = "INSERT INTO tbl_signup (username, email, password)
                    VALUES ('$username','$email','$hashedPassword')";

            if($conn->query($sql)){
                $_SESSION['success'] = "Successfully Registered!";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['error'] = "Registration Failed.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>

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

  <div class="signup-wrapper">

    <div class="card signup-card shadow">
      <div class="card-body p-4">
        <h3 class="text-center fw-bold mb-4">Create Account</h3>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

           <?php if($error_message != ""): ?>
           <div class="alert alert-danger"><?php echo $error_message; ?></div>
           <?php endif; ?>

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter your name" value="<?= $_POST['username'] ?? '' ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?= $_POST['email'] ?? '' ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" value="<?= $_POST['password'] ?? '' ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="conpassword" class="form-control" id="conpassword" placeholder="Confirm password" value="<?= $_POST['conpassword'] ?? '' ?>">
          </div>

          <div class="mb-3">
           <label class="form-label">Gender</label>
           <select name="gender" class="form-select" required>xml_error_string
           <option disabled <?= !isset($_POST['gender']) ? 'selected' : '' ?>>Select gender</option>
           <option value="Male" <?= (isset($_POST['gender']) && $_POST['gender'] == "Male") ? 'selected' : '' ?>>Male</option>
           <option value="Female" <?= (isset($_POST['gender']) && $_POST['gender'] == "Female") ? 'selected' : '' ?>>Female</option>
           </select>
          </div>

          <button type="submit" name= "btn" class="btn btn-primary w-100 fw-semibold"> Sign Up    </button>
          <p class="text-center mt-3 mb-0">
            Already have an account?
            <a href="login.php" class="text-decoration-none fw-semibold">Log in</a>
          </p>  

        </form>
      </div>
    </div>

  </div>


  <?php if(isset($_SESSION['success'])){ ?>
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        <?php echo $_SESSION['success']; ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
<?php unset($_SESSION['success']); } ?>

<?php if(isset($_SESSION['error'])){ ?>
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        <?php echo $_SESSION['error']; ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
<?php unset($_SESSION['error']); } ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var toastEl = document.getElementById('successToast');
    var toastError = document.getElementById('errorToast');
    if(toastEl){
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }else if(toastError){
      var toast = new bootstrap.Toast(toastError);
        toast.show();
    }
});

setTimeout(() => {
    document.querySelector('.toast')?.classList.remove('show');
}, 3000)
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
