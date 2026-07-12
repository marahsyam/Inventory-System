<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if(isset($_POST['add'])){

    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO categories(category_name, description)
            VALUES('$category_name','$description')";

    if(mysqli_query($conn,$sql)){
        header("Location: categories.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <h4>Add Category</h4>
    </div>

    <div class="card-body">

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input
                    type="text"
                    name="category_name"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"></textarea>
            </div>

            <button type="submit" name="add" class="btn btn-success">
                Add Category
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