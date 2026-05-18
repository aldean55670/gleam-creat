<?php
session_start();
if($_SESSION['admin'] !== 'admin'){
    header('Location:../index.php');
    exit();
    }



include ('header.php');
include ('conect.php');


// Create Record
if (isset($_POST['product_title']) && !isset($_GET['product_id'])) {
    $ext_allowed = ['png', 'jpg', 'jpeg'];
    $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);

    if (!in_array($ext, $ext_allowed)) {
        die('Extension not allowed');
    }

    $image_path = "images/" . uniqid('image-') . "." . $ext;
    $file_uploaded = @move_uploaded_file($_FILES['image1']['tmp_name'], "../$image_path");

    if ($file_uploaded) echo 'Image Uploaded Successfully';
    else echo 'Image not Uploaded';

    $query = "INSERT INTO products (
        product_title,
        product_description,
        product_keywords,
        occasion_id,
        category_id,
        product_image1,
        product_price,
        status
    ) VALUES (
        '$_POST[product_title]',
        '$_POST[product_description]',
        '$_POST[product_keywords]',
        '$_POST[occasion_id]',
        '$_POST[category_id]',
        '$image_path',
        '$_POST[product_price]',
        '$_POST[status]'
    )";

    mysqli_query($con, $query);

// Update Record
} else if (isset($_POST['product_title']) && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "UPDATE products SET
        product_title='$_POST[product_title]',
        product_description='$_POST[product_description]',
        product_keywords='$_POST[product_keywords]',
        occasion_id='$_POST[occasion_id]',
        category_id='$_POST[category_id]',
        product_price='$_POST[product_price]',
        status='$_POST[status]'
        WHERE product_id=$product_id";

    mysqli_query($con, $query);
} ?>

<?php
$data = [];
if(isset($_GET['product_id'])){
    $product_id = htmlspecialchars($_GET['product_id'], ENT_QUOTES | ENT_SUBSTITUTE);
    $query_product = "SELECT * FROM products WHERE product_id=$product_id";
    $result = '';
    if ($product_id) $result = mysqli_query($con, $query_product);
    $data = mysqli_fetch_assoc($result) ?? [];
}
?>

<div class="container py-5">
    <div class="mb-3">
        <a href="total_product.php" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-left-long" style="color: rgb(10, 24, 36);"></i> Back
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">

                    <h2 class="mb-4 text-center fw-bold">
                        Add New Product
                    </h2>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <!-- Product Title -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product Title
                            </label>

                            <input
                                type="text"
                                id="product_title"
                                name="product_title"
                                class="form-control form-control-lg"
                                placeholder="Enter product title"
                                required
                                value="<?= htmlspecialchars($data['product_title'] ?? '') ?>"
                            >
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea
                                class="form-control"
                                name="product_description"
                                id="product_description"
                                rows="4"
                                placeholder="Write product description..."
                                required
                            ><?= htmlspecialchars($data['product_description'] ?? '') ?></textarea>
                        </div>

                        <!-- Product Keywords -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product Keywords
                            </label>

                            <input
                                type="text"
                                name="product_keywords"
                                id="product_keywords"
                                class="form-control"
                                placeholder="Example: shoes, sport, nike"
                                required
                                value="<?= htmlspecialchars($data['product_keywords'] ?? '') ?>"
                            >
                        </div>
                        <!-- upload photo -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                upload photo
                            </label>

                            <input
                                type="file"
                                name="image1"
                                id="image1"
                                class="form-control"
                                accept="image/*"
                                required
                            >
                        </div>

                        <!-- Category & Occasion -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Category ID
                                </label>

                                <select name="category_id" id="category_id" class="form-select" placeholder="Category ID" required>
                                    <option value="0">Select Category</option>
                                    <?php
                                    $result = mysqli_query($con, 'SELECT category_id, category_title FROM `gift_categories`');
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?= $row['category_id'] ?>" <?= ($row['category_id'] == ($data['category_id'] ?? 0)) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['category_title']) ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Occasion ID
                                </label>

                                <select name="occasion_id" id="occasion_id" class="form-select" placeholder="Occasion ID" required>
                                    <option value="0">Select Occasion</option>
                                    <?php
                                    $result = mysqli_query($con, 'SELECT occasion_id, occasion_title FROM `occasion`');
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?= $row['occasion_id'] ?>" <?= ($row['occasion_id'] == ($data['occasion_id'] ?? 0)) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($row['occasion_title']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>  
                        </div>

                        <!-- Product Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product Price
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">EGP</span>

                                <input
                                    type="number"
                                    name="product_price"
                                    value="<?= htmlspecialchars($data['product_price'] ?? '') ?>"
                                    id="product_price"
                                    class="form-control"
                                    placeholder="0.00"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select"
                            >
                                <option value="active" <?= ($data['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= ($data['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button 
                                type="submit"
                                class="btn btn-dark btn-lg rounded-3"
                            >
                                Add Product
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


</body>
</html>