<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM orders WHERE id='$id'");
$order = mysqli_fetch_assoc($result);

$users = mysqli_query($conn,"SELECT * FROM users");

if(isset($_POST['update'])){

    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $order_date = $_POST['order_date'];

    $sql = "UPDATE orders
            SET user_id='$user_id',
                status='$status',
                order_date='$order_date'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        header("Location: orders.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

<div class="card-header bg-warning">
<h4>Edit Order</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Customer</label>

<select name="user_id" class="form-control">

<?php while($user=mysqli_fetch_assoc($users)){ ?>

<option value="<?php echo $user['id']; ?>"
<?php if($user['id']==$order['user_id']) echo "selected"; ?>>

<?php echo $user['full_name']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option value="pending"
<?php if($order['status']=="pending") echo "selected"; ?>>
Pending
</option>

<option value="completed"
<?php if($order['status']=="completed") echo "selected"; ?>>
Completed
</option>

<option value="cancelled"
<?php if($order['status']=="cancelled") echo "selected"; ?>>
Cancelled
</option>

</select>

</div>

<div class="mb-3">

<label>Order Date</label>

<input
type="date"
name="order_date"
class="form-control"
value="<?php echo $order['order_date']; ?>">

</div>

<button
class="btn btn-success"
name="update">

Update

</button>

<a href="orders.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

<?php
include "../includes/footer.php";
?>