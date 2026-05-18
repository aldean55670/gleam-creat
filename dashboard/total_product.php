<?php
include('../includes/header.php');
include('../includes/conect.php');

$query = "SELECT product_id, product_title,product_price, product_image1, status, created_at FROM products ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
$total = mysqli_num_rows($result);
?>



<div class="container mt-4">
    <div class="mb-3">
        <a href="javascript:history.back()" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-left-long" style="color: rgb(10, 24, 36);"></i> Back
        </a>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Products Management</h2>
                <a href="../management.php"><button class="btn btn-primary">creat-product</button></a>
                <span class="badge badge-primary" style="font-size: 16px; padding: 8px 12px;">Total: <?php echo $total; ?></span>
            </div>
            <hr class="mt-3">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th style="width: 80px;">Image</th>
                    <th>Title</th>
                    <th>price</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 150px;">Created Date</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($total > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status_class = ($row['status'] == 'active') ? 'badge-success' : 'badge-danger';
                        echo "<tr>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td><img src='../images/" . $row['product_image1'] . "' alt='Product' style='width: 50px; height: 50px; object-fit: cover; border-radius: 4px;'></td>";
                        echo "<td><strong>" . $row['product_title'] . "</strong></td>";
                        echo "<td><strong>" . $row['product_price'] . "</strong></td>";
                        echo "<td><span class='badge {$status_class}'>" . ucfirst($row['status']) . "</span></td>";
                        echo "<td>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</td>";
                        echo "<td>";
                        echo "<a href='edit_product.php?id=" . $row['product_id'] . "' class='btn btn-sm btn-primary me-2'><i class='fas fa-edit'></i> Edit</a>";
                        echo "<button class='btn btn-sm btn-danger' onclick=\"deleteProduct(" . $row['product_id'] . ")\"><i class='fas fa-trash'></i> Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-muted py-4'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        // إرسال طلب حذف إلى ملف delete_product.php
        window.location.href = 'delete_product.php?id=' + productId;
    }
}
</script>

<?php include('../includes/footer.php'); ?>