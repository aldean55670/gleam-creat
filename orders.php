<?php
session_start();
include './includes/header.php';
include './includes/conect.php';
include './includes/navbar.php';
if (!isset($_SESSION['username'])) {
    ?>
<!-- if order is empty -->
<div class="container mt-5">
    <div class="alert alert-info text-center py-5">
        <div style="font-size: 3rem; margin-bottom: 20px;">📦</div>
        <h2>There are no requests</h2>
        <p>No orders have been placed yet.</p>
        <a href="index.php" class="btn btn-primary mt-3">
            shopping Now 
        </a>
    </div>
</div>
<?php
    return;
}

$username = $_SESSION['username'];
$query = "SELECT * FROM orders where username ='$username' ";
$result = mysqli_query($con, $query);
$orders = [];
while($data = mysqli_fetch_assoc($result)){
    $orders[] = $data;
}
if (empty($orders)) {
?>
<div class="container mt-5">
    <div class="alert alert-info text-center py-5">
        <div style="font-size: 3rem; margin-bottom: 20px;">📦</div>
        <h2>There are no requests</h2>
        <p>No orders have been placed yet.</p>
        <a href="index.php" class="btn btn-primary mt-3">
            shopping Now 
        </a>
    </div>
</div>
<?php
    return;
}
?>
<div class="container mt-5">
    <h2 class="mb-4">Orders</h2>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>status</th>
                    <th>count</th>
                    <th>number request</th>
                    <th>price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order){ ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($order['product_name'] ?? 'N/A'); ?></strong></td>
                    <td>
                        <?php
                        $status = $order['status'] ?? 'pending';
                        $badgeClass = $status === 'completed' ? 'bg-success' : ($status === 'pending' ? 'bg-warning text-dark' : 'bg-info');
                        echo "<span class='badge $badgeClass'>" . htmlspecialchars($status) . '</span>';
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($order['quantity'] ?? '0'); ?></td>
                    <td><code><?php echo htmlspecialchars($order['id'] ?? 'N/A'); ?></code></td>
                    <td><?php echo htmlspecialchars($order['price'] ?? '0'); ?></td>
                    <td><?php echo $order['date']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>