<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";

$order_id = $_GET['order_id'];

$products = mysqli_query($conn,"SELECT * FROM products");

if(isset($_POST['save'])){

    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];

    // جلب سعر المنتج
    $result = mysqli_query($conn,"SELECT price FROM products WHERE id='$product_id'");
    $product = mysqli_fetch_assoc($result);

    $price = $product['price'];
  

    // إضافة المنتج إلى الطلب
    mysqli_query($conn,"
        INSERT INTO order_details(order_id,product_id,quantity,price)
        VALUES('$order_id','$product_id','$quantity','$price')
    ");


    // تحديث إجمالي الطلب
    mysqli_query($conn,"
        UPDATE orders
        SET total_price=
        (
            SELECT SUM(quantity*price)
            FROM order_details
            WHERE order_id='$order_id'
        )
        WHERE id='$order_id'
    ");

    header("Location: order_details.php?order_id=".$order_id);
    exit();
}

include "../includes/header.php";
include "../includes/sidebar.php";
?>

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h4>Add Product To Order</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Product</label>

<select name="product_id" class="form-control" required>

<option value="">Choose Product</option>

<?php while($row=mysqli_fetch_assoc($products)){ ?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['product_name']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Quantity</label>

<input
type="number"
name="quantity"
class="form-control"
required
min="1">

</div>

<button
class="btn btn-success"
name="save">

Save

</button>

<a href="order_details.php?order_id=<?php echo $order_id; ?>"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

<?php
include "../includes/footer.php";
?>