<?php
session_start();
if ($_SESSION['admin'] !== 'admin') {
    header('Location:../index.php');
    exit();
}
$page_title = 'Total Orders - Dashboard';
$heading = 'total-orders';
include('./includes/header.php');

include ('./conect.php');
include ('./navbar.php');

$orders = mysqli_query($con, 'SELECT * FROM `orders` ORDER BY id DESC');
$totalOrders = mysqli_num_rows($orders);

$totalRevenue = mysqli_query($con, 'SELECT SUM(price) as revenue FROM `orders`');
$revenueRow = mysqli_fetch_assoc($totalRevenue);
$revenue = $revenueRow['revenue'] ?? 0;

// var_dump($revenue);

$pendingOrders = mysqli_query($con, "SELECT COUNT(*) as count FROM `orders` WHERE status = 'paid'");
$pendingRow = mysqli_fetch_assoc($pendingOrders);
$pending = $pendingRow['count'] ?? 0;

$cashingOrders = mysqli_query($con, "SELECT COUNT(*) as count FROM `orders` WHERE status = 'cashing'");
$cashingRow = mysqli_fetch_assoc($cashingOrders);
$cashing = $cashingRow['count'] ?? 0;

$completedOrders = mysqli_query($con, "SELECT COUNT(*) as count FROM `orders` WHERE status = 'completed'");
$completedRow = mysqli_fetch_assoc($completedOrders);
$completed = $completedRow['count'] ?? 0;
?>

<div class="container-fluid py-4" style="flex-grow: 1;">
    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="blueviolet mb-2">
            <i class="fa-solid fa-chart-line"></i> Orders Management
        </h1>
        <p class="text-muted">Monitor all customer orders and track sales performance</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid blueviolet;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Orders</p>
                            <h2 id = 'total_order_dashboard' class="blueviolet mb-0"><?= $totalOrders ?></h2>
                        </div>
                        <i class="fa-solid fa-boxes-stacked fa-3x" style="color: #e8d5f2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #28a745;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Revenue</p>
                            <h2 style="color: #28a745;" class="mb-0" id='total_price_dash'>$<?= number_format($revenue, 2) ?></h2>
                        </div>
                        <i class="fa-solid fa-money-bill-wave fa-3x" style="color: #d4edda;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #ffc107;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">cashing Orders</p>
                            <h2 style="color: #ffc107;" class="mb-0"><?= $cashing ?></h2>
                        </div>
                        <i class="fa-solid fa-hourglass-end fa-3x" style="color: #fff3cd;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #ffc107;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Pending Orders</p>
                            <h2 style="color: #ffc107;" class="mb-0"><?= $pending ?></h2>
                        </div>
                        <i class="fa-solid fa-hourglass-end fa-3x" style="color: #fff3cd;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #17a2b8;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Completed Orders</p>
                            <h2 style="color: #17a2b8;" class="mb-0"><?= $completed ?></h2>
                        </div>
                        <i class="fa-solid fa-circle-check fa-3x" style="color: #d1ecf1;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="blueviolet mb-0">
                <i class="fa-solid fa-list"></i> All Orders
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if ($totalOrders > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                                <tr>
                                    <td><strong>#<?= $row['id'] ?></strong></td>
                                    <td><?= htmlspecialchars($row['username'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
                                    <td><strong>$<?= number_format($row['price'] ?? 0, 2) ?></strong></td>
                                    <td>
                                        <?php
                                        $status = $row['status'] ?? 'pending';
                                        $badgeClass = 'bg-warning';
                                        $statusText = 'Pending';

                                        if ($status === 'completed') {
                                            $badgeClass = 'bg-success';
                                            $statusText = 'Completed';
                                        } elseif ($status === 'cashing') {
                                            $badgeClass = 'bg-danger';
                                            $statusText = 'cashing';
                                        } elseif ($status === 'paid') {
                                            $badgeClass = 'bg-info';
                                            $statusText = 'pending';
                                        }
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                                    </td>
                                    <td><?= $row['date'] ?></td>
                                    <td>
                                        <a href="../product_details.php?product_id=<?php echo $row['product_id'];?>">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#orderModal<?= $row['id'] ?>">
                                                <i class="fa-solid fa-eye"></i> View
                                            </button>
                                        </a>
                                        <?php if($row['status'] === 'cashing'){?>
                                            <button order-id = "del-<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-delete="<?= $row['product_id'] ?>">
                                                <i class="fa-solid fa-eye"></i> Delete
                                            </button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fa-solid fa-inbox fa-4x text-muted mb-3" style="opacity: 0.3;"></i>
                    <p class="text-muted fs-5">No orders found</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="bg-light text-center py-4 mt-5">
    <p class="text-muted mb-0">&copy; GLeam Creates. All rights reserved.</p>
</footer>


</body>

<!-- delete order from database -->
<script>
    $(document).ready(function(){
            $('[order-id]').click(function(e){
                e.preventDefault();
                let id = $(this).data('delete');
                console.log(id);
                
                let item = $(this).closest('tr');
                console.log( item)
                $.ajax({
                    url:"delete_order.php",
                    method:'post',
                    dataType:'json',
                    data:{
                        order_id: id
                    },
                    success: function(res){
                        console.log(res)
                        item.remove()
                        $('#total_order_dashboard').text(res.count ?? 0)
                        $('#total_price_dash').text(res.total ?? 0)
                        
                    },
                    error: function(xhr,status,error){
                        console.log('error')
                    }
                })
            })
        })
</script>
</html>
<?php include('includes/footer.php')?>