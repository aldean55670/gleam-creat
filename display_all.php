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
        <div class="parentCards">
            <?php
            get_all_product();
            get_uniqe_category();
            get_uniqe_occasion();
            ?>
        </div>
    </div>

    <?php include("includes/footer.php") ?>
    </body>
    <script>
        <?php ?>
        let productID = <?= isset($_GET['add_to_cart']) ? (int)$_GET['add_to_cart'] : die() ?>;
        $(document).ready(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'cart.php',
                    method: 'get',
                    data: {
                        product_id: productID
                    },
                    success: function(data) {
                        console.log('sucsess');
                    },
                    error: function(error) {
                        consol.log(error)
                    }
                })
            })
        })
    </script>

    </html>