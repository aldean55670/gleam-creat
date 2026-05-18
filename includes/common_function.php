<?php
function get_occasion()
{
    global $con;
    $select_occasion = "SELECT * FROM `occasion`";
    $result_occasion = mysqli_query($con, $select_occasion);
    while ($row = mysqli_fetch_assoc($result_occasion)) {
        $occassion_id = $row['occasion_id'];
        $occassion_title = $row['occasion_title'];
        echo "<li class='nav-item'><a href='index.php?occasion=$occassion_id' class='nav-link'>$occassion_title</a></li>";
    }
}

function get_gift_categories()
{
    global $con;
    $select_category = "SELECT * FROM `gift_categories`";
    $result_category = mysqli_query($con, $select_category);
    while ($row = mysqli_fetch_assoc($result_category)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        echo "<li class='nav-item'><a href='index.php?category=$category_id' class='nav-link'>$category_title</a></li>";
    }
}

function get_product()
{
    global $con;
    $select_product = "SELECT products.*, gift_categories.category_title, occasion.occasion_title 
                        FROM `products` LEFT JOIN `gift_categories`
                        ON products.category_id = gift_categories.category_id LEFT JOIN 
                        `occasion` ON products.occasion_id = occasion.occasion_id LIMIT 0,9;";
    $result_product = mysqli_query($con, $select_product);
    while ($row = mysqli_fetch_assoc($result_product)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $product_category = $row['category_title'];
        $product_occasion = $row['occasion_title'];

        if (isset($_GET['occasion']) || isset($_GET['category'])) return;
        echo "
            <div class='card smothy'>
                <img src= '$product_image1' alt='Product Image' class='card-img-top '>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                    <p class='card-text'> $product_category </p>
                    <p class='card-text'> $product_occasion </p>

                    <div class='card-price'>Price : $product_price <span>EGP</span></div>
                    <a 
                        class='btn btn-primary' add-to-cart data-product-id=$product_id>
                        <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                    </a>
                    <a href='product_details.php?product_id=$product_id'  class='btn'>
                        <i class='fas fa-eye me-2 ' style='color: black;'></i>view
                    </a>
                </div>
            </div>
            ";
    }
}

function get_all_product()
{
    global $con;
    $select_product = "SELECT products.*, gift_categories.category_title, occasion.occasion_title 
                        FROM `products` LEFT JOIN `gift_categories` ON products.category_id = gift_categories.category_id 
                        LEFT JOIN `occasion` ON products.occasion_id = occasion.occasion_id;";
    $result_product = mysqli_query($con, $select_product);
    while ($row = mysqli_fetch_assoc($result_product)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $product_category = $row['category_title'];
        $product_occasion = $row['occasion_title'];
        if (isset($_GET['occasion']) || isset($_GET['category'])) return;
        echo "
            <div class='card smothy'>
                <img src= '$product_image1' alt='Product Image' class='card-img-top '>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                    <p class='card-text'> $product_category </p>
                    <p class='card-text'> $product_occasion </p>

                    <div class='card-price'>Price : $product_price <span>EGP</span></div>
                    <a 
                        class='btn btn-primary' add-to-cart data-product-id=$product_id>
                        <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                    </a>
                    <a href='product_details.php?product_id=$product_id'  class='btn'>
                        <i class='fas fa-eye me-2 ' style='color: black;'></i>view
                    </a>
                </div>
            </div>
            ";
    }
}
function get_uniqe_category()
{

    global $con;
    if (isset($_GET['category'])) {
        $category_id = intval($_GET['category']);
        $select_category = "SELECT * FROM `products` WHERE category_id = $category_id";
        $result = mysqli_query($con, $select_category);

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            echo "
                    <div class='card smothy'>
                        <img src= '$product_image1' alt='Product Image' class='card-img-top '>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                            <div class='card-price'>Price : $product_price <span>EGP</span></div>
                            <a href='index.php?add_to_cart=$product_id' 
                                class='btn btn-primary  add-to-cart'  add-to-cart  data-id=$product_id>
                                <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                            </a>
                            <a href='product_details.php?product_id=$product_id'  class='btn'>
                                <i class='fas fa-eye me-2 ' style='color: black;'></i>view
                            </a>
                        </div>
                    </div>
                    ";
        }
    }
}

function get_uniqe_occasion()
{
    global $con;
    if (isset($_GET['occasion'])) {
        $occasion_id = intval($_GET['occasion']);
        $select_occasion = "SELECT * FROM `products` WHERE occasion_id = $occasion_id";

        $result = mysqli_query($con, $select_occasion);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            if (isset($_GET['occasion'])) {
                echo "
                    <div class='card smothy'>
                        <img src='$product_image1' alt='Product Image' class='card-img-top '>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                            <div class='card-price'>Price : $product_price <span>EGP</span></div>
                            <a href='index.php?add_to_cart=$product_id' 
                                class='btn btn-primary  add-to-cart'  data-id=$product_id>
                                <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                            </a>
                            <a href='product_details.php?
                                product_id=$product_id' class='btn'>
                                <i class='fas fa-eye me-2 ' style='color: black;'></i>view
                            </a>
                        </div>
                    </div>
                    ";
            }
        }
    }
}
function get_product_view()
{
    global $con;
    $prodect_id = $_GET['product_id'];
    $select_product = "SELECT * FROM `products` WHERE product_id=$prodect_id";
    $result_product = mysqli_query($con, $select_product);
    $row = mysqli_fetch_assoc($result_product);
    if (!$row) return false;
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_image1 = $row['product_image1'];
    $product_price = $row['product_price'];
    $result = "
        <div class='container'>
            <div class='view_product'>
                <img src= '$product_image1' class=' width500 rounded mx-auto d-block' alt='Responsive image' '>
                <div class=''>
                    <h5 class='text-center >$product_title</h5>
                    <div class='container_view_product'>
                        <p class=' alert alert-info'> $product_description</p>
                        <div class='text-center alert alert-'>Price : $product_price <span class='red'>EGP</span></div>
                    <a href='' 
                        class='btn btn-primary w-100  add-to-cart' add-to-cart  data-id=$product_id>
                        <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                    </a>
                    </div>
                </div>
            </div>
        </div>
            ";
    return $result;
}






