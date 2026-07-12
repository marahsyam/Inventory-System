<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if(!isset($_GET['order_id'])){
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['order_id'];

$sql = "SELECT od.*, p.product_name
        FROM order_details od
        INNER JOIN products p ON od.product_id = p.id
        WHERE od.order_id='$order_id'";

$result = mysqli_query($conn,$sql);
?>

<div class="card shadow">

<div class="card-header bg-primary text-white d-flex justify-content-between">

<h4>Order Details</h4>

<div>

<a href="add_order_detail.php?order_id=<?php echo $order_id; ?>"
class="btn btn-success">

+ Add Product

</a>

<a href="orders.php"
class="btn btn-light">

Back

</a>

</div>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Product</th>
<th>Quantity</th>
<th>Unit Price</th>
<th>Total</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['order_detail_id']; ?></td>

<td><?php echo $row['product_name']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>$<?php echo number_format($row['price'],2); ?></td>

<td>$<?php echo number_format($row['price']*$row['quantity'],2); ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<?php
include "../includes/footer.php";
?>