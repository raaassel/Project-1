<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

 <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
  <div class="container-fluid px-5">
    <a class="navbar-brand fw-bold" href="#">LUTONG INA MO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto gap-4 me-3">
        <li class="nav-item"><a class="nav-link fw-semibold" href="dash.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="profile.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold btn btn-danger btn-sm" href="login.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
<div class="container my-5">

<div class="row justify-content-center">
<div class="col-lg-6 col-md-8 col-12">

<div class="card shadow">
<div class="card-body">

<!-- PROFILE DISPLAY -->
<div class="text-center mb-4">
  <img src="https://via.placeholder.com/150"
       class="rounded-circle profile-img mb-3 img-fluid">

  <h4 class="fw-bold">Admin User</h4>
  <p class="text-muted">admin@email.com</p>
</div>

<hr>

<!-- EDIT PROFILE FORM -->
<h5 class="fw-bold mb-3">Edit Profile</h5>

<form>

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" class="form-control" value="Admin User">
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" class="form-control" value="admin@email.com">
</div>

<div class="mb-3">
<label class="form-label">Phone</label>
<input type="text" class="form-control" value="09123456789">
</div>

<div class="mb-3">
<label class="form-label">Address</label>
<input type="text" class="form-control" value="Binan, Laguna">
</div>

<div class="mb-3">
<label class="form-label">Change Profile Picture</label>
<input type="file" class="form-control">
</div>

<button class="btn btn-warning w-100 fw-semibold">
Save Changes
</button>

</form>

</div>
</div>

</div>
</div>

</div>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
© 2026 LUTONG INA MO
</footer>

</body>
</html>