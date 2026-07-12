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

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $role       = $_POST['role'];
    $status    = $_POST['status'];

    $sql = "UPDATE users SET
            full_name='$full_name',
            email='$email',
            role='$role',
            status='$status'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        header("Location: users.php");
        exit();
    }else{
        echo mysqli_error($conn);
    }
}
?>

<div class="card shadow">

<div class="card-header bg-warning">
<h4>Edit User</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="full_name"
class="form-control"
value="<?php echo $user['full_name']; ?>" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email"
class="form-control"
value="<?php echo $user['email']; ?>" required>
</div>

<div class="mb-3">
<label>Role</label>
<select name="role" class="form-control">

<option value="admin"
<?php if($user['role']=="admin") echo "selected"; ?>>
Admin
</option>

<option value="user"
<?php if($user['role']=="user") echo "selected"; ?>>
User
</option>

</select>
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-control">

<option value="active"
<?php if($user['status']=="active") echo "selected"; ?>>
Active
</option>

<option value="inactive"
<?php if($user['status']=="inactive") echo "selected"; ?>>
Inactive
</option>

</select>
</div>

<button class="btn btn-success" name="update">
Update
</button>

<a href="users.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

<?php
include "../includes/footer.php";
?>