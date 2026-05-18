<?php
include(__DIR__ . "/includes/header.php");
    include(__DIR__ . "/includes/conect.php");
    include(__DIR__ . "/includes/common_function.php");
?>

<script>
    document.title = 'Gleam-creats - products_details'
</script>

<?php include(__DIR__ . "/includes/navbar.php") ?>

<?php 
$cotnet = get_product_view();

if ($cotnet != false) {
    echo $cotnet;
} else {?>
    <div class="container mt-4 alert alert-danger">Sorry, this product not found.</div>
<?php } ?>

<?php include(__DIR__ . "/includes/footer.php") ?>
</body>
</html>