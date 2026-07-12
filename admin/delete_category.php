<?php
include "../config/db.php";

$id = $_GET['id'];

$check = mysqli_query($conn,"
SELECT *
FROM products
WHERE category_id='$id'
");

if(mysqli_num_rows($check) > 0){

    echo "<script>
    alert('Cannot delete this category because it contains products.');
    window.location='categories.php';
    </script>";
    exit();
}

mysqli_query($conn,"DELETE FROM categories WHERE id='$id'");

header("Location: categories.php");
exit();
?>