<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

// جلب جميع التصنيفات
$categories = mysqli_query($conn, "SELECT * FROM categories");

// عند الضغط على زر الإضافة
if(isset($_POST['add'])){$image = "";

if($_FILES['image']['name'] != ""){

    $image = time()."_".$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../uploads/".$image
    );
}


    $product_name = $_POST['product_name'];
    $description  = $_POST['description'];
    $price        = $_POST['price'];
    $quantity     = $_POST['quantity'];
    $category_id  = $_POST['category_id'];

    // رفع الصورة
    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/" . $image
        );
    }

    // حفظ المنتج
  $sql = "INSERT INTO products
(category_id, product_name, description, price, quantity, image)
VALUES
('$category_id','$product_name','$description','$price','$quantity','$image')";

    if(mysqli_query($conn,$sql)){
        header("Location: products.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<?php
include "../includes/header.php";
include "../includes/sidebar.php";
?>

<div class="container">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Add Product</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">Category</label>

<select name="category_id" class="form-select" required>

<option value="">Choose Category</option>

<?php
while($cat = mysqli_fetch_assoc($categories)){
?>

<option value="<?php echo $cat['id']; ?>">

<?php echo $cat['category_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label class="form-label">Product Name</label>

<input
type="text"
name="product_name"
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

<div class="row">

<div class="col-md-6">

<label class="form-label">Price</label>

<input
type="number"
step="0.01"
name="price"
class="form-control"
required>

</div>

<div class="col-md-6">

<label class="form-label">Quantity</label>

<input
type="number"
name="quantity"
class="form-control"
required>

</div>

</div>

<br>

<div class="mb-3">

<label class="form-label">Product Image</label>

<input
type="file"
name="image"
class="form-control">

</div>

<button
type="submit"
name="add"
class="btn btn-success">

<i class="fa-solid fa-plus"></i>

Add Product

</button>

<a href="products.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php
include "../includes/footer.php";
?>