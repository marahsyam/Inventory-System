<?php
include "../config/db.php";

$id = $_GET['id'];

$check = mysqli_query($conn,"
SELECT *
FROM orders
WHERE user_id='$id'
");

if(mysqli_num_rows($check) > 0){

    echo "<script>
    alert('Cannot delete this user because there are orders linked to it.');
    window.location='users.php';
    </script>";
    exit();
}

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location: users.php");
exit();
?>