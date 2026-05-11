<?php 
ob_start();
session_start();

include "../includes/conect.php";



if(!isset($_SESSION['username'])){
    header("Location:login.php");
    exit();
}


$username = $_SESSION['username'];
$result_chick_chick = [];

if(isset($_GET['product_id'])){
    $product_id = (int) ($_GET['product_id'] ?? 0);
    $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `products` WHERE product_id = $product_id"));
    if ($product) {
        $query = "INSERT INTO cart (
                username,
                product_id,
                product_title,
                price,
                image
            ) VALUES (
                '$username',
                '$product[product_id]',
                '$product[product_title]',
                '$product[product_price]',
                '$product[product_image1]'

            )";
    
        $res = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) > 0) {
            $result_chick = ['success' => true, 'message' => 'Product add to cart successfully'];

        if(!$res){

        die(mysqli_error($con));
        }
            } else {
            header('HTTP/1.1 404 Not Found');
            $result_chick = ['success' => false, 'message' => 'Failed to add product to cart'];
        }
    } else {
        header('HTTP/1.1 404 Not Found');
        $result_chick = ['success' => false, 'message' => 'Product not found'];
    }

    $query2 = "SELECT COUNT(*)  as count, SUM(price) as total
            FROM cart
            WHERE username = '$username'";

    $result = mysqli_query($con, $query2);
    $row = mysqli_fetch_assoc($result);

    header('Content-type: application/json');
    echo json_encode([
            'result_chick' => $result_chick,
        'success' => true,
        'count' => $row['count'],
        'total' => $row['total']
    ]);
    exit;
}



ob_end_flush();
?>
