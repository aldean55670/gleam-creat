<?php @session_start();?>
<?php include __DIR__ . "/conect.php";

$res = @mysqli_query($con, "SELECT SUM(total_price) as total_cash ,SUM(`count`) as totalcount FROM cart where username = '$_SESSION[username]'");
$row = mysqli_fetch_assoc($res);
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top px-4">
    <div class="container-fluid">
        <a class="navbar-brand logo-link blueviolet" href="../index.php">
            <i class="fa-brands fa-42-group"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../display_all.php">Products</a>
                </li>
                <?php if(isset($_SESSION['username']) && $_SESSION['username']){?>
                <li class="nav-item">
                    <a href="../mycart.php" class="nav-link blueviolet">
                        <i class=" fa-solid fa-cart-shopping"></i>
                        <sup id='count'>
                            <?=$row['totalcount']??0;?>
                        </sup>
                    </a>
                </li>
                <?php }?>
                
                <li class="nav-item">
                    <a class="nav-link"  class=''>Total : $ <span id="total-price"><?= $row['total_cash']??0;?></span>/EGP </a>
                </li>
                <?php if($_SESSION['admin'] === 'admin'){ ?>
                <li class="nav-item">
                    <a class="btn btn-primary" href="dashboard.php">
                        dashBoard
                    </a>
                </li>
                <?php }?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" id="search" type="search" placeholder="Search products ...." style="min-width: 200px; " aria-label="Search" />
                <div class='position-relative'>
                    <i class="fas fa-search iconSearch"></i>
                </div>
            </form>

            <!-- icon sign in  -->
            <?php if(isset($_SESSION['username']) && $_SESSION['username']){?>
                <ul class="mb-0 " >
                    <li class="nav-item" style="list-style:none">
                        <a class="nav-link" href="../My-Acount.php">
                            <!-- i this -->
                            <?php 
                            $user = substr(strtoupper($_SESSION['username']), 0, 1);
                            echo "<div class='logo-login'>$user</div>";
                            ?>
                        </a>
                    </li>
                </ul>
                
            <?php }else{?>
                        <ul class="mb-0">
                    <li class="nav-item" style="list-style:none">
                        <a class="btn btn-primary" href="../My-Acount.php">
                            LOGIN
                        </a>
                    </li>
                </ul>
                <?php }?>
        </div>
    </div>
</nav>
