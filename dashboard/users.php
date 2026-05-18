<?php
include('../includes/header.php');
include('../includes/conect.php');

$query = "SELECT username,email FROM register";
$result = mysqli_query($con,$query);
?>
<div class="container mt-4">
    <div class="mb-3">
        <a href="javascript:history.back()" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-left-long" style="color: rgb(10, 24, 36);"></i> Back
        </a>
    </div>

    <div class="mb-4">
        <h2>All Users</h2>
    </div>

    <div class='table-responsive'>
        <table class='table table-bordered table-hover align-middle text-center'>
            <thead class='table-dark'>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username'])?></td>
                    <td><?php echo htmlspecialchars($row['email'])?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning me-2"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>  