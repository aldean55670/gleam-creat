
<?php

$heading = 'Home Page';
include('includes/header.php') ?>

<div class="app-content">

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
                        <a href="total_product.php">
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
                        <a href="total_order.php">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Total Orders</p>
                                    <h3 id='total_order' class="mb-0">0</h3>
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
                        <a href="users.php">
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


</div>
<!--end::App Content-->

<?php include('includes/footer.php')?>