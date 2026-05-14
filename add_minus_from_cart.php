<?php
ob_start();
session_start();
$username = $_SESSION['username'];
include('includes/conect.php');


if(isset($_POST['item_id'])){
    $data=[];
    $content_Id = htmlspecialchars($_POST['item_id']);
    global $con;
    $query = "UPDATE `cart` SET `count` = `count` +1 WHERE `cart`.`id` = $content_Id ";

    mysqli_query($con,$query);


    $query2="SELECT total_price, count 
            FROM cart WHERE id= $content_Id;";

    $result = mysqli_query($con,$query2);

    $row = mysqli_fetch_assoc($result);
    
    }
    header('Content-Type: application/json');
        echo json_encode([
            'count' => $row['count'],
            'total_price' => $row['total_price']
        ]);
ob_end_flush();