<?php include("includes/header.php");


if(isset($_POST)) {


}

?>

<script>
    document.title = 'Create Products'
</script>
<div class="flex-grow-1">
    <?php include("includes/navbar.php") ?>

    <form method="POST" enctype="multipart/form-data" class="container mt-4">

        <div class="row" style="max-width: 100%;">

            <!-- Title -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="product_title" class="form-control" placeholder="Enter product title">
            </div>

            <!-- Price -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="product_price" class="form-control" placeholder="Enter price">
            </div>

            <!-- Description -->
            <div class="col-12 mb-3">
                <label class="form-label">Description</label>
                <textarea name="product_description" class="form-control" rows="4"></textarea>
            </div>

            <!-- Keywords -->
            <div class="col-12 mb-3">
                <label class="form-label">Keywords</label>
                <input type="text" name="product_keywords" class="form-control" placeholder="comma separated keywords">
            </div>

            <!-- Occasion ID -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Occasion ID</label>
                <select name="occasion_id" class="form-control">
                    <option value="">Select Occasion</option>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM `occasion`");
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?= $row['occasion_id'] ?>"><?= $row['occasion_title'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Category ID -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Category ID</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM `gift_categories`");
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?= $row['category_id'] ?>"><?= $row['category_title'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Images -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Image 1</label>
                <input type="file" name="product_image1" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Image 2</label>
                <input type="file" name="product_image2" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Image 3</label>
                <input type="file" name="product_image3" class="form-control">
            </div>

            <!-- Status -->
            <div class="col-12 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Insert Product</button>
            </div>

        </div>
    </form>
</div>

<?php include("includes/footer.php") ?>
</body>

</html>