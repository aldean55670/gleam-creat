<?php
    ob_start();

    include __DIR__ . "/includes/conect.php";
    include __DIR__ . "/includes/header.php";
    include __DIR__ . "/includes/navbar.php";

    if(!isset($_SESSION['username'])){
        header("Location:login.php");
        exit();
    }

    $username = $_SESSION['username'];
    $query = "SELECT product_title , price,image,id,count,total_price
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
                <?php while ($row = mysqli_fetch_assoc($result_show)) { 
                    
                    ?>
                    <tr  >
                        <td>
                            <img src="<?= $row['image'];?>"
                                width="70"
                                class="rounded">
                        </td>
                        <td><?= $row['product_title']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td counter>
                            <div class="parent-counter">
                                <span id ="add-<?= $row['id']; ?>"> <?= $row['count'];?> </span>
                                <span class="btn-uppdate">
                                        <button class="plus"  add_1 data-content_id ="<?= $row['id']; ?>" ><i class="fa-solid fa-plus fa-xs"></i></button>
                                        <button class="minus" minus_1 data-content_id ="<?= $row['id']; ?>" style="padding: 0 0px 2px 0;">-</button>
                                </span>
                            </div>
                        </td>
                        <td totalPrice id ="total-<?= $row['id']; ?>">
                            <?= $row['total_price'];?> 
                        </td>
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
        <?php if(mysqli_num_rows($result_show) >= 1){?>
        <div>
            <div class='btns-pay'>
                <div class="text-center" id="btn-pay">
                    <a href="./Pay/pay.php" class='white ' >
                            <button id="payNow" class="btn btn-primary ">
                            Pay Now
                        </button>
                        </a>
                </div>
                <div class="text-center" id="btn-cash">
                    <a href="./Pay/cash" class='white ' >
                            <button id="cash" class="btn btn-primary ">
                            Cash Delevary
                        </button>
                        </a>
                </div>
        </div>

        </div>
        <?php } ?>
        
    </div>

    <!-- DELETE FROM CART -->

    <script>
        $(document).ready(function(){
            $('[delete-item]').click(function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let item = $(this).closest('tr');
                $.ajax({
                    url:"requests/delete_from_cart.php",
                    method:'post',
                    dataType:'json',
                    data:{
                        element_id: id
                    },
                    success: function(res){
                        
                        item.remove()
                        $('sup').text(res.count ?? 0)
                        $('#total-price').text(`${res.total ?? 0}`)
                        if(res.count < 1){
                            $('#btn-pay').hide();
                        }
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

    <!-- add plus(1) count in the cart -->
    <script>
        $(document).ready(function (){
            $(document).on('click','[add_1]',function(){
                let contentId = $(this).data('content_id');
                // console.log(this);
                $.ajax({
                    url:"add_minus_from_cart.php",
                    method:"post",
                    dataType:'json',
                    data:{
                        item_id: contentId
                    },
                    success:function(res){
                        $(`#add-${contentId}`).text(res.count);
                        $(`#total-${contentId}`).text(res.total_price);
                        $('#count').text(res.total_row_count)
                        $('#total-price').text(res.total_row_price)
                    },
                    error:function(){
                        console.log("error")
                    }
                })
            })
        })
    </script>
<!-- minus (1) count in the cart  -->
    <script>
        $(document).ready(function (){
            $(document).on('click','[minus_1]',function(e){
                let contentId = $(this).data('content_id');
                // if($(`#add-${contentId}`).text() == 1) return;
                $.ajax({
                    url:"add_minus_from_cart.php",
                    method:"post",
                    dataType:'json',
                    data:{
                        item_id_minus: contentId
                    },
                    success:function(res){
                        console.log('success')
                        

                        
                        $(`#add-${contentId}`).text(res.count);
                        $(`#total-${contentId}`).text(res.total_price);
                        $('#count').text(res.total_row_count)
                        $('#total-price').text(res.total_row_price)
                    },
                    error:function(){
                        console.log("error")
                    }
                })
            })
        })
    </script>

        </body>
        </html>
