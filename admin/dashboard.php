<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";

$product_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
$category_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM categories"));
$user_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$order_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));

$sales = mysqli_query($conn,"SELECT SUM(total_price) AS total_sales FROM orders");
$sales = mysqli_fetch_assoc($sales);
$total_sales = $sales['total_sales'];

if($total_sales == NULL){
    $total_sales = 0;
}
$latest_orders = mysqli_query($conn,"
SELECT orders.id, users.full_name, orders.total_price, orders.status
FROM orders
INNER JOIN users ON orders.user_id = users.id
ORDER BY orders.id DESC
LIMIT 5
");

include "../includes/header.php";
include "../includes/sidebar.php";
?>

<h2>Dashboard</h2>

<div class="alert alert-success">
    Welcome <?php echo $_SESSION['full_name']; ?>
</div>

<div class="row">

<div class="col-md-4">
    <div class="card shadow">
        <div class="card-body">
            <h5>Products</h5>
            <h2><?php echo $product_count; ?></h2>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card shadow">
        <div class="card-body">
            <h5>Categories</h5>
            <h2><?php echo $category_count; ?></h2>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card shadow">
        <div class="card-body">
            <h5>Users</h5>
            <h2><?php echo $user_count; ?></h2>
        </div>
    </div>
</div>

<div class="col-md-4 mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h5>Orders</h5>
            <h2><?php echo $order_count; ?></h2>
        </div>
    </div>
</div>

<div class="col-md-4 mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h5>Total Sales</h5>
            <h2>$<?php echo number_format($total_sales,2); ?></h2>
        </div>
    </div>
</div>

</div>
<hr class="mt-5">

<div class="card shadow mt-4">

<div class="card-header bg-dark text-white">
<h4>Latest Orders</h4>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>
<th>ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($latest_orders)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td>$<?php echo number_format($row['total_price'],2); ?></td>

<td><?php echo ucfirst($row['status']); ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<?php
include "../includes/footer.php";
?>