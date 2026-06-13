<?php
session_start();
include('conect.php');
if (!isset($_POST['cashing'])) {
    header('Location:../index.php');
}


if (isset($_POST['cashing'])) {
    $username = $_SESSION['username'];
    $query = "INSERT INTO orders (product_name,product_id, status, count, username,price)
            SELECT product_title,product_id, 'cashing', count,  username,price
            FROM cart
            WHERE username = '$username';";
$result = mysqli_query($con, $query);

$query2 = "DELETE FROM cart WHERE username ='$username'";
$result2 = mysqli_query($con, $query2);

}
