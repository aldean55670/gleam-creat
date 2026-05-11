<?php
    ob_start();
    @session_start();

    include "./includes/conect.php";
    include "./includes/header.php";
    include "./includes/navbar.php";

    if(!isset($_SESSION['username'])){
        header("Location:login.php");
        exit();
    }

    $username = $_SESSION['username'];
    $query = "SELECT product_title , price,image,id
                FROM cart 
                WHERE username = '$username' ";
    $result_show = mysqli_query($con,$query);
    ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center blueviolet">My Products</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_show)) { ?>
                    <tr  >
                        <td>
                            <img src="./images/<?= $row['image'];?>"
                                width="70"
                                class="rounded">
                        </td>
                        <td><?= $row['product_title']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td>1</td>
                        <td>3</td>
                        <td>
                            <a href="" class="btn" delete-item  data-id = "<?= $row['id'] ;?>">
                                <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DELETE FROM CART -->
    <script>
        $(document).ready(function(){
            $('[delete-item]').click(function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let item = $(this).closest('tr');
                $.ajax({
                    url:"delete_from_cart.php",
                    method:'post',
                    dataType:'json',
                    data:{
                        element_id: id
                    },
                    success: function(res){
                        // console.log(res)
                        item.remove()
                        $('sup').text(res.count)
                        $('#total-price').text(`${res.total ?? 0}`)
                        console.log(res.total)
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






            
    </body>
    </html>
                        <!-- let nav = $('nav');
                        nav.html( `
                            <div class="container-fluid">
                                <a class="navbar-brand logo-link" href="index.php">
                                    <i class="fa-brands fa-42-group"></i>
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link " href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="display_all.php">Products</a>
                                        </li>
                                                    <li class="nav-item">
                                            <a href="mycart.php" class="nav-link">
                                                <i class=" fa-solid fa-cart-shopping"></i>
                                                <sup id='count'><?= $row['count'];?></sup>
                                            </a>
                                        </li>
                                            <li class="nav-item">
                                <a class="nav-link" href="#">Total : $<?= $row['total']; ?>/- </a>
                        `); -->
