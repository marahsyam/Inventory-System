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

$sql = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products SET
            product_name='$product_name',
            description='$description',
            price='$price',
            quantity='$quantity'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        header("Location: products.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

    <div class="card-header bg-warning text-dark">
        <h4>Edit Product</h4>
    </div>

    <div class="card-body">

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input
                    type="text"
                    name="product_name"
                    class="form-control"
                    value="<?php echo $row['product_name']; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"><?php echo $row['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input
                    type="number"
                    step="0.01"
                    name="price"
                    class="form-control"
                    value="<?php echo $row['price']; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    class="form-control"
                    value="<?php echo $row['quantity']; ?>"
                    required>
            </div>

            <button type="submit" name="update" class="btn btn-success">
                Update Product
            </button>

            <a href="products.php" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

<?php
include "../includes/footer.php";
?>