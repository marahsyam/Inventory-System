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

$sql = "SELECT * FROM categories WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    $sql = "UPDATE categories SET
            category_name='$category_name',
            description='$description'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        header("Location: categories.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

    <div class="card-header bg-warning text-dark">
        <h4>Edit Category</h4>
    </div>

    <div class="card-body">

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input
                    type="text"
                    name="category_name"
                    class="form-control"
                    value="<?php echo $row['category_name']; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"><?php echo $row['description']; ?></textarea>
            </div>

            <button type="submit" name="update" class="btn btn-success">
                Update Category
            </button>

            <a href="categories.php" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

<?php
include "../includes/footer.php";
?>