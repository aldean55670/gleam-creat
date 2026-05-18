<?php
include("conect.php");

session_start();
global $con;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $element_id = $_POST['element_id'];
    $query = "DELETE FROM products WHERE product_id  = $element_id";
    mysqli_query($con,$query);
    


    $query_products="SELECT COUNT(*) AS count_product FROM products";
    $count_product= mysqli_fetch_assoc( mysqli_query($con,$query_products));


    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'count_product' =>$count_product['count_product']
        ]);
    
    exit;
    }