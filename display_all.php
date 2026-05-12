<?php
    include("includes/header.php");
    include("includes/conect.php");
    include("includes/common_function.php");
?>

<script>
    document.title = 'Gleam - creats - Home'
</script>
<div class="flex-grow-1">
    <?php include("includes/navbar.php") ?>
    <!-- Home page -->
    <div class="container my-4">
        <div class="hero-banner">Find The Perfect Gift For Every Occasion!</div>
    </div>
    <div class="container-cards container">
        <div class="row">  
            <div>
                <h4>Occasion</h4>
                <ul class="navebar-nav">
                    <?php get_occasion(); ?>
                </ul>
                <h4>Gift Categories</h4>
                <ul class="navebar-nav">
                    <?php get_gift_categories(); ?>
                </ul>
            </div>
        </div>
        <div class="parentCards" id="data">
            <?php
            get_all_product();
            get_uniqe_category();
            get_uniqe_occasion();
            ?>
        </div>
    </div>

    <?php include("includes/footer.php") ?>
    </body>
<!-- ADD TO CART  -->
    <script>
        $(document).ready(function() {
            $(document).on('click','[add-to-cart]',function(e) {
                let productID = $(this).data('product-id');
                $.ajax({
                    url: 'requests/cart.php',
                    method: 'GET',
                    dataType:'json',
                    data: {
                        product_id: productID
                    },
                    success: function(data) {
                        let contnet = `
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="alert alert-success d-flex justify-content-between gap-3">
                                    <div>${data.result_chick.message}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        `;
                        $('body').append(contnet);
                        $('sup').text(data.count)
                        $('#total-price').text(`${data.total ?? 0}`)

                        let toast = new bootstrap.Toast(document.getElementById('liveToast'));
                        toast.show();
                    },
                    error: function(error) {
                        console.log(error)
                        let contnet = `
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="alert alert-danger d-flex justify-content-between gap-3">
                                    <div>${error.result_chick.message}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        `;
                        $('body').append(contnet);

                        let toast = new bootstrap.Toast(document.getElementById('liveToast'));
                        toast.show();
                        console.log(error)
                    }
                })
            })
        })
    </script>
<!-- SEARCH -->
    <script>
        $(document).ready(function() {  
            let parentcard = $('#data').text() 
            
            $('#search').on('input',function() {
            $.ajax({
                url: './search.php',
                method: 'post',
                dataType:'json',
                data:{
                    keyword: $('#search').val()
                },
                success: function(res){//data-count
                    console.log('success');
                    if(res.count > 0){
                        $('#data').text('');
                        let content ='';
                        res.data.forEach(function(item, index){
                            console.log(item.product_id)
                            content += ` 
                                    <div class='card smothy'>
                                        <img src= 'images/${item.product_image1}' alt='Product Image' class='card-img-top '>
                                        <div class='card-body'>
                                            <h5 class='card-title'>${item.product_title}</h5>

                                            <div class='card-price'>Price : ${item.product_price} <span>EGP</span></div>
                                            <a 
                                                class='btn btn-primary' add-to-cart data-product-id=${item.product_id}>
                                                <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                                            </a>
                                            <a href='product_details.php?product_id=${item.product_id}'  class='btn'>
                                                <i class='fas fa-eye me-2 ' style='color: black;'></i>view
                                            </a>
                                        </div>
                                    </div>
                            `;
                            $('#data').html(content);
                        });
                    }
                    

                },
                error: function(){
                    console.log('error')
                }
            })
            })
        })
    </script>

    </html>