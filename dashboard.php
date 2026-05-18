<?php
session_start();
include("includes/header.php");
include("includes/conect.php");

$page_title = 'Gleam - Dashboard';
$username = $_SESSION['username'];
if($username != 'hossam'){
    header('Location:index.php');
    exit();
    }
include("includes/common_function.php");
?>

<div class="flex-grow-1">
    <?php include("includes/navbar.php"); ?>
    <div class="container-fluid py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-4" style="color:blueviolet;"><i class="fas fa-chart-line me-2" ></i>Dashboard</h1>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <a href="dashboard/total_product.php">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Total Products</p>
                                    <h3 class="mb-0">0</h3>
                                </div>
                                <i class="fas fa-box fa-3x text-primary opacity-50"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <a href="dashboard/total_order.php">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Total Orders</p>
                                    <h3 class="mb-0">0</h3>
                                </div>
                                <i class="fas fa-shopping-bag fa-3x text-success opacity-50"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <a href="#">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Revenue</p>
                                    <h3 class="mb-0"> EGP</h3>
                                </div>
                                <i class="fas fa-coins fa-3x text-warning opacity-50"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <a href="dashboard/users.php">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Users</p>
                                    <h3 class="mb-0"><?php echo isset($total_users) ? $total_users : '0'; ?></h3>
                                </div>
                                <i class="fas fa-users fa-3x text-info opacity-50"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Tables Section -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center py-5">No data available yet</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Quick Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="display_all.php" class="list-group-item list-group-item-action">
                                <i class="fas fa-th me-2"></i>View Products
                            </a>
                            <a href="mycart.php" class="list-group-item list-group-item-action">
                                <i class="fas fa-shopping-cart me-2"></i>Cart
                            </a>
                            <a href="My-Acount.php" class="list-group-item list-group-item-action">
                                <i class="fas fa-user me-2"></i>My Account
                            </a>
                            <a href="logout.php" class="list-group-item list-group-item-action text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</div>

</body>
</html>
