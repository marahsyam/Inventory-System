<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if(isset($_POST['save'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $rol = $_POST['rol'];
    $status = $_POST['status'];

    $sql = "INSERT INTO users(full_name,email,password,rol,status)
            VALUES('$full_name','$email','$password','$rol','$status')";

    if(mysqli_query($conn,$sql)){
        header("Location: users.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

<div class="card-header bg-success text-white">
<h4>Add User</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Role</label>
<select name="rol" class="form-control">
    <option value="user">User</option>
    <option value="admin">Admin</option>
</select>
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-control">
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
</select>
</div>

<button type="submit" name="save" class="btn btn-success">
Save User
</button>

<a href="users.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

<?php
include "../includes/footer.php";
?>