<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$users = mysqli_query($conn,"SELECT * FROM users");

if(isset($_POST['save'])){

    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $order_date = $_POST['order_date'];

    $sql = "INSERT INTO orders(user_id,total_price,status,order_date)
            VALUES('$user_id','0','$status','$order_date')";

    if(mysqli_query($conn,$sql)){
        header("Location: orders.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <h4>Add Order</h4>
    </div>

    <div class="card-body">

        <form method="POST">

            <div class="mb-3">

                <label>Customer</label>

                <select name="user_id" class="form-control" required>

                    <option value="">Choose Customer</option>

                    <?php while($user = mysqli_fetch_assoc($users)){ ?>

                        <option value="<?php echo $user['id']; ?>">
                            <?php echo $user['full_name']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select name="status" class="form-control" required>

                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>

                </select>

            </div>

            <div class="mb-3">

                <label>Order Date</label>

                <input
                    type="date"
                    name="order_date"
                    class="form-control"
                    required>

            </div>

            <button
                class="btn btn-success"
                name="save">

                Save Order

            </button>

            <a href="orders.php" class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

<?php
include "../includes/footer.php";
?>