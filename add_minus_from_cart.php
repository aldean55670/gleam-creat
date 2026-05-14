<?php
ob_start();
session_start();
$username = $_SESSION['username'];
include('includes/conect.php');

    $data=[];
    if(isset($_POST['item_id_minus'])){
        $content_Id = htmlspecialchars($_POST['item_id_minus']);
        global $con;
        $query = "UPDATE `cart` SET `count` = `count` -1 WHERE `cart`.`id` = $content_Id ";
        mysqli_query($con,$query);
    }
    if(isset($_POST['item_id'])){
        $content_Id = htmlspecialchars($_POST['item_id']);
        global $con;
        $query = "UPDATE `cart` SET `count` = `count` +1 WHERE `cart`.`id` = $content_Id ";
        mysqli_query($con,$query);
    }
    $query2="SELECT total_price, count 
            FROM cart WHERE id= $content_Id;";
    $result = mysqli_query($con,$query2);
    $row = mysqli_fetch_assoc($result);
    
    $query3= "SELECT 
                    SUM(`count`) AS total_row_count,
                    SUM(total_price) AS total_row_price
                FROM cart
                WHERE username = '$username';";
    $result2 = mysqli_query($con,$query3);
    $row2 = mysqli_fetch_assoc($result2);

    header('Content-Type: application/json');
        echo json_encode([
            'count' => $row['count'],
            'total_price' => $row['total_price'],
            'total_row_count' => $row2['total_row_count'],
            'total_row_price' => $row2['total_row_price'],

        ]);
ob_end_flush();