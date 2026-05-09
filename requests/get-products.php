<?php
include "../includes/conect.php";
global $con;
$select_product = "SELECT products.*, gift_categories.category_title, occasion.occasion_title FROM `products` LEFT JOIN `gift_categories` ON products.category_id = gift_categories.category_id LEFT JOIN `occasion` ON products.occasion_id = occasion.occasion_id;";
$result_product = mysqli_query($con, $select_product);
$data = [];
while ($row = mysqli_fetch_assoc($result_product)) {
    $data[]= $row;
}

header("Content-type: application/json");
echo json_encode($data);
exit;