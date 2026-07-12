<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT products.*, categories.category_name
        FROM products
        LEFT JOIN categories
        ON products.category_id = categories.id";

$result = mysqli_query($conn, $sql);

include "../includes/header.php";
include "../includes/sidebar.php";
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Products</h2>

    <a href="add_product.php" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Product
    </a>

</div>

<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td>

                        <?php
                        if(!empty($row['image'])){
                        ?>

                        <img src="../uploads/<?php echo $row['image']; ?>" width="60">

                        <?php
                        }else{
                            echo "No Image";
                        }
                        ?>

                    </td>

                    <td><?php echo $row['product_name']; ?></td>

                    <td><?php echo $row['category_name']; ?></td>

                    <td><?php echo $row['description']; ?></td>

                    <td>$<?php echo $row['price']; ?></td>

                    <td><?php echo $row['quantity']; ?></td>

                    <td>

                        <a href="edit_product.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="delete_product.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this product?');">
                           Delete
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php
include "../includes/footer.php";
?>