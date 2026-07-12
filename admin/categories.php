<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$sql = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h4>Categories</h4>

        <a href="add_category.php" class="btn btn-light btn-sm">
            + Add Category
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th width="180">Action</th>
                </tr>

            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['category_name']; ?></td>

                    <td><?php echo $row['description']; ?></td>

                    <td>

                        <a href="edit_category.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="delete_category.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this category?');">
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