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

    <!-- DELETE BTN -->
    <script>
        $(document).ready(function(){
            $('[delete-item]').click(function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let item = $(this).closest('tr');
                $.ajax({
                    url:"",
                    method:'post',
                    data:{
                        element_id: id
                    },
                    success: function(){
                        item.remove();
                        let v = $('#count').text();
                        v = Number(v) - 1;
                        $('#count').text(v);   
                    },
                    error: function(){
                        console.log('error')
                    }
                })
            })
        })
    </script>

    <?php
    global $con;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $element_id = $_POST['element_id'];
        $query="DELETE FROM `cart` WHERE id = $element_id";
        mysqli_query($con,$query);
    }
    ?>
</body>
</html>

