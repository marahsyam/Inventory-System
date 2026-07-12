<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT orders.*, users.full_name
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        ORDER BY orders.id DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<h2>Orders</h2>

<a href="dashboard.php" class="btn btn-secondary">Dashboard</a>

<a href="add_order.php" class="btn btn-primary">
+ Add Order
</a>

<br><br>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Customer</th>
<th>Total Price</th>
<th>Status</th>
<th>Order Date</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['full_name']; ?></td>

<td>$<?= $row['total_price']; ?></td>

<td><?= ucfirst($row['status']); ?></td>

<td><?= $row['order_date']; ?></td>

<td>

<a href="order_details.php?order_id=<?php echo $row['id']; ?>"
class="btn btn-info btn-sm">
Details
</a>

<a href="edit_order.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<a href="delete_order.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this order?');">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>