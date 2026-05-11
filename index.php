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
                get_product();
                get_uniqe_category();
                get_uniqe_occasion();
            ?>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
<!-- ADD TO CART  -->
    <script>
        $(document).ready(function() {
            $('[add-to-cart]').click(function(e) {
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
                                    <div>${errorr.result_chick.message}</div>
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

    </body>

    </html>