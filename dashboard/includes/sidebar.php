<?php 
$con=mysqli_connect('localhost','root','','mystore');
if(!$con){
    die('connection failed: '.mysqli_connect_error());
}


$resultOrders = mysqli_query($con," SELECT COUNT(*) as totalOrder FROM orders");
$resultUsers = mysqli_query($con," SELECT COUNT(*) as totalUsers FROM  register");
$resultProducts = mysqli_query($con," SELECT COUNT(*) totalProducts FROM  products");
$users = mysqli_fetch_assoc($resultUsers)['totalUsers'];
$orders = mysqli_fetch_assoc($resultOrders)['totalOrder'];
$products = mysqli_fetch_assoc($resultProducts)['totalProducts'];

?>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.php" class="brand-link">
        <img
            src="./assets/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow"
        />
        <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="navigation"
            aria-label="Main navigation"
            data-accordion="false"
            id="navigation"
        >
            <li class="nav-header">Product Management</li>
            <!-- products -->
            <li class="nav-item">
                <a href="total_product.php" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>
                        Product
                        <span class="badge badge-info right"><?= $products?></span>
                    </p>
                </a>
            </li>
            <!-- users -->
            <li class="nav-item">
                <a href="users.php" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>
                        Users
                        <span class="badge badge-info right"><?= $users?></span>
                    </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="total_order.php" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>
                        Total Orders
                        <span class="badge badge-info right"><?= $orders?></span>
                    </p>
                </a>
            </li>
    <!--end::Sidebar Menu-->
        </nav>
    </div>
</aside>
