<?php
include('includes/header.php');
include('includes/conect.php');
if(isset($_POST['product_title'])){
$product_title = $_POST['product_title'];
$product_description = $_POST['product_description'];
$product_keywords = $_POST['product_keywords'];
$category_id = $_POST['category_id'];
$occasion_id = $_POST['occasion_id'];
$product_price = $_POST['product_price'];
$status = $_POST['status'];


    $image_name = $_FILES['image1']['name'];
    $tmp_name = $_FILES['image1']['tmp_name'];
    move_uploaded_file($tmp_name , "images/$image_name");

    echo "Image Uploaded Successfully";



$query = "INSERT INTO products 
(
    product_title,
    product_description,
    product_keywords,
    occasion_id,
    category_id,
    product_image1,
    product_price,
    status
)

VALUES
(
    '$product_title',
    '$product_description',
    '$product_keywords',
    '$occasion_id',
    '$category_id',
    '$image_name',
    '$product_price',
    '$status'
)";
mysqli_query($con,$query);
}
?>
<div class="container py-5">
    <div class="mb-3">
        <a href="./dashboard/total_product.php" class="btn btn-sm btn-outline-dark">
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
                                name="product_title"
                                class="form-control form-control-lg"
                                placeholder="Enter product title"
                                required
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
                                rows="4"
                                placeholder="Write product description..."
                                required
                            ></textarea>
                        </div>

                        <!-- Product Keywords -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product Keywords
                            </label>

                            <input 
                                type="text"
                                name="product_keywords"
                                class="form-control"
                                placeholder="Example: shoes, sport, nike"
                                required
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

                                <input 
                                    type="number"
                                    name="category_id"
                                    class="form-control"
                                    placeholder="Category ID"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Occasion ID
                                </label>

                                <input 
                                    type="number"
                                    name="occasion_id"
                                    class="form-control"
                                    placeholder="Occasion ID"
                                    required
                                >
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
                                class="form-select"
                            >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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