<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<div class="card shadow">

<div class="card-header bg-primary text-white">
<div class="d-flex justify-content-between align-items-center">

<h4>Users</h4>

<a href="add_user.php" class="btn btn-success">
+ Add User
</a>

</div>
</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Full Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo ucfirst($row['role']); ?></td>

<td><?php echo ucfirst($row['status']); ?></td>

<td>

<a href="edit_user.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<a href="delete_user.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this user?');">
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