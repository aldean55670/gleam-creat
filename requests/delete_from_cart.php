<?php
include("../includes/conect.php");

session_start();
global $con;




if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $element_id = $_POST['element_id'];
    
    mysqli_query($con, "DELETE FROM cart WHERE id = $element_id");
    
    $username = $_SESSION['username'];
    
    $query = "SELECT SUM(`count`) as total_count, SUM(total_price) AS t_price, count(product_title) as num
                FROM cart
                WHERE username = '$username'";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'count' => $row['total_count'],
    'total' => $row['t_price'],
    'num'   => $row['num']
    ]);
    
    exit;
    }
    