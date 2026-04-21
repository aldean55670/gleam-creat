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
    $select_product = "SELECT * FROM `products` ORDER BY RAND()";
    $result_product = mysqli_query($con, $select_product);
    while ($row = mysqli_fetch_assoc($result_product)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];

        if (isset($_GET['occasion']) || isset($_GET['category'])) return;
        echo "
            <div class='card'>
                <img src= 'images/$product_image1' alt='Product Image' class='card-img-top '>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                    <div class='card-price'>Price : $product_price <span>E.G.P</span></div>
                    <a href='index.php?add_to_cart=$product_id' 
                        class='btn btn-primary'  style='background-color:blueviolet;'>
                        <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                    </a>
                    <a href='product_details.php?
                        product_id=$product_id'  class='btn'>
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
                    <div class='card'>
                        <img src= 'images/$product_image1' alt='Product Image' class='card-img-top '>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                            <div class='card-price'>Price : $product_price <span>E.G.P</span></div>
                            <a href='index.php?add_to_cart=$product_id' 
                                class='btn btn-primary'  style='background-color:blueviolet;'>
                                <i class='fas fa-cart-plus me-2' style='color: white;'></i>Add To Cart
                            </a>
                            <a href='product_details.php?
                                product_id=$product_id'  class='btn'>
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
                    <div class='card'>
                        <img src='images/$product_image1' alt='Product Image' class='card-img-top '>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>" . substr($product_description, 0, 30) . "</p>
                            <div class='card-price'>Price : $product_price <span>E.G.P</span></div>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary' style='background-color:blueviolet;'>
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
