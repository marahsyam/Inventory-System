<?php
include "config/db.php";

if(isset($_POST['register']))
{
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users(full_name,email,password,rol,status)
            VALUES('$full_name','$email','$password','user','active')";

    if(mysqli_query($conn,$sql)){
        echo "Registered Successfully";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<form method="POST">

<input type="text" name="full_name" placeholder="Full Name" required>
<br><br>

<input type="email" name="email" placeholder="Email" required>
<br><br>

<input type="password" name="password" placeholder="Password" required>
<br><br>

<button type="submit" name="register">Register</button>

</form>