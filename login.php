<?php
include "config/db.php";
session_start();

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'
            AND status='active'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        header("Location: admin/dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header bg-primary text-white text-center">
<h4>Inventory Login</h4>
</div>

<div class="card-body">

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100" name="login">
Login
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>