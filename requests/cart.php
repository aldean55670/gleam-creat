<?php

ob_start();
session_start();

include "../includes/conect.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$product_id = (int) ($_GET['product_id']);
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
        $message = 'Product add to cart successfully';
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['success' => false, 'message' => 'Failed to add product to cart', 'count' => 0, 'total' => 0]);
        exit;
    }
} else {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['success' => false, 'message' => 'Product not found', 'count' => 0, 'total' => 0]);
    exit;
}

$query2 = "SELECT SUM(`count`)  as total_count, SUM(price) as total FROM cart WHERE username = '$username'";

$result = mysqli_query($con, $query2);
$row = mysqli_fetch_assoc($result);

header('Content-type: application/json');
echo json_encode([
    'message' => $message,
    'success' => true,
    'count' => $row['total_count'],
    'total' => $row['total']
]);

exit;