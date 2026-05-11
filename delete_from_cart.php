<?php
include("includes/conect.php");
header('Content-Type: application/json');
session_start();
global $con;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $element_id = $_POST['element_id'];

    mysqli_query($con, "DELETE FROM cart WHERE id = $element_id");

    $username = $_SESSION['username'];

    $query = "SELECT COUNT(*) as count, SUM(price) as total
                FROM cart
                WHERE username = '$username'";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    echo json_encode([
        'success' => true,
        'count' => $row['count'],
        'total' => $row['total']
    ]);

    exit;
}