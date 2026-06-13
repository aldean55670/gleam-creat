<?php
session_start();
if ($_SESSION['admin'] !== 'admin') {
    header('Location:../index.php');
    exit();
}
$heading = 'Products Management';
include ('includes/header.php');
include ('header.php');
include ('conect.php');

$query = 'SELECT product_id, product_title, product_price, product_image1, status, created_at FROM products ORDER BY created_at DESC';
$result = mysqli_query($con, $query);
$total = mysqli_num_rows($result);
?>


<?php include ('navbar.php'); ?>
<div class="mb-4">
        <div class="d-flex justify-content-end align-items-center">
            
            <div class="d-flex gap-5">
                <a href="management.php" class="btn btn-primary">+ Create Product</a>
                <p  class="badge bg-primary fs-6" id=count_product>Total:<?php echo $total; ?></p>
            </div>
        </div>
        <hr class="my-3">
    </div>
    <div class="container mt-4">
    
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Item</th>
                    <th style="width: 80px;">Image</th>
                    <th>Title</th>
                    <th>ProductId</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                <?php if ($total > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php $status_class = ($row['status'] == 'active') ? 'bg-success' : 'bg-danger'; ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><img src="../<?= $row['product_image1'] ?>" alt="Product" class="rounded" style="width: 50px; height: 50px; object-fit: cover;"></td>
                            <td><?= htmlspecialchars($row['product_title']) ?></td>
                            <td><?= $row['product_id'] ?></td>
                            <td><?= number_format($row['product_price'], 2) ?> EGP</td>
                            <td><span class="badge <?= $status_class ?>"><?= ucfirst($row['status']) ?></span></td>
                            <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                            <td>
                                <a href='management.php?product_id=<?= $row['product_id'] ?>'  data-id=<?= $row['product_id'] ?> class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <a href='' delete-item data-id=<?= $row['product_id'] ?>><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No products found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

    <script>
        $(document).ready(function(){
            $('[delete-item]').click(function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let item = $(this).closest('tr');
                console.log(id)
                $.ajax({
                    url:"delete_from_all.php",
                    method:'post',
                    dataType:'json',
                    data:{
                        element_id: id
                    },
                    success: function(res){
                        console.log("sucsess")
                        item.remove()
                        $('#count_product').text(`Total:${res.count_product ?? 0}`)
                        
                    },
                    error: function(xhr,status,error){
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log('error');
                    }
                })
            })
        })
    </script>


<?php include ('includes/footer.php') ?>