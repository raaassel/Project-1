<?php

session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$name = $_SESSION['user'];

$sql = "SELECT * FROM tbl_signup";
$result = $conn->query($sql);


// ADD USER
if(isset($_POST['add_user'])){

    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $status = $_POST["status"];

    // CHECK EMAIL
    $checkEmail = "SELECT * FROM tbl_signup WHERE email='$email'";
    $checkResult = $conn->query($checkEmail);

    if($checkResult->num_rows > 0){

        $_SESSION['error'] = "Email already registered!";

    } else {

        $sql = "INSERT INTO tbl_signup (username,email,role,status)
                VALUES ('$username','$email','$role','$status')";

        if($conn->query($sql)){
            $_SESSION['success'] = "User Successfully Added!";
        } else {
            $_SESSION['error'] = "User Adding Failed.";
        }
    }

    header("Location: dash.php");
    exit();
}



// DELETE USER
if(isset($_POST['delete_user'])){

    $id = $_POST['del_id'];

    $sql = "DELETE FROM tbl_signup WHERE id='$id'";

    if($conn->query($sql)){
        $_SESSION['success'] = "User Successfully Deleted!";
    }else{
        $_SESSION['error'] = "User Deletion Failed.";
    }

    header("Location: dash.php");
    exit();
}

// EDIT USER
if(isset($_POST['update_user'])){

    $id = $_POST['edit_id'];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $status = $_POST["status"];

    $sql = "UPDATE tbl_signup SET username= '$username', email='$email', role='$role', status='$status'
            WHERE id='$id'";

    if($conn->query($sql)){
        $_SESSION['success'] = "User Updated Successfully!";
    }else{
        $_SESSION['error'] = "Update Failed.";
    }

    header("Location: dash.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
  <div class="container-fluid px-5">
    <a class="navbar-brand fw-bold" href="#">DASHBOARD</a>
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


<div class="container my-5">

<!-- ================= DASHBOARD ================= -->
<section id="dashboard">

  <!-- Button trigger modal -->
   <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
      Add User
    </button>
   </div>

  <div class="card shadow">
    <div class="card-body">

      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
            <?php while($row = $result->fetch_assoc()){  ?>
            <tr>
              <td> <?php echo $row['id']; ?> </td>
              <td> <?php echo $row['username']; ?> </td>
              <td> <?php echo $row['email']; ?> </td>
              <td> <?php echo $row['role']; ?> </td>
              <td> <?php echo $row['status']; ?> </td>
              <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>"> Edit</button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>"> Delete</button>
              </td>
            </tr>

              <!-- EDIT MODAL -->
                  <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1"aria-labelledby="editModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">

                  <form method="POST">

                  <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">

                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">

                  <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                  </div>

                  <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                  </div>

                  <div class="mb-3">
                  <label class="form-label">Role</label>
                  <select name="role" class="form-select">
                  <option value="admin" >Admin</option>
                  <option value="user" selected>User</option>
                  </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    </select>
                    </div>
                  </div>

                  <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                  </div>

                  </form>

                </div>
              </div>
            </div>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <form method="POST">

                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel<?php echo $row['id']; ?>">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <div class="modal-body">
                        <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                        <p>Are you sure you want to delete this user?</p>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_user" class="btn btn-danger">Confirm Delete</button>
                      </div>

                    </form>

                  </div>
                </div>
              </div>
            <?php } ?>
        </tbody>
      </table>

    </div>
  </div>
</section>

</div>

<!-- ===== MODALS ===== -->


<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" >
      <div class="modal-body">

           <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Name" required>
           </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
          </div>

          <div class="mb-3">
           <label class="form-label">Role</label>
           <select name="role" class="form-select">
           <option value="admin" >Admin</option>
           <option value="user" selected>User</option>
           </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_user" class="btn btn-primary">Submit</button>
      </div>
    </div>
    </form>
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