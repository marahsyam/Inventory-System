<?php
include "../config/db.php";

$id = $_GET['id'];

$check = mysqli_query($conn,"
SELECT *
FROM order_details
WHERE product_id='$id'
");

if(mysqli_num_rows($check) > 0){

    echo "<script>
    alert('Cannot delete this product because it exists in orders.');
    window.location='products.php';
    </script>";
    exit();
}

mysqli_query($conn,"DELETE FROM products WHERE id='$id'");

header("Location: products.php");
exit();
?>