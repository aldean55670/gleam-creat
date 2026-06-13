<?php
ob_start();
session_start();
include './conect.php';
require_once 'config.php';

if (!isset($_GET['session_id'])) {
    header('Location:../index.php');
}

if (!$_SESSION['username']) {
    header('Location:../login.php');
}
$username = $_SESSION['username'];
$session_id = $_GET['session_id'];

$init = curl_init();
curl_setopt($init, CURLOPT_URL, 'https://api.stripe.com/v1/checkout/sessions/' . $session_id);
curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($init, CURLOPT_USERPWD, $secretKey . ':');
curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($init);

$data = json_decode($response, true);

if ($data['payment_status'] === 'paid') {
    $check_query = "SELECT id FROM orders WHERE session_id = '$session_id' LIMIT 1";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        if (mysqli_query($con, $check_query)) {
            $query = "INSERT INTO orders (product_name,product_id, status, count, username,session_id,price)
            SELECT product_title,product_id, 'paid', count,  username,'$session_id',price
            FROM cart
            WHERE username = '$username';";

            $result = mysqli_query($con, $query);  
            mysqli_query($con, "DELETE FROM cart WHERE username = '$username'");
        }
    } else {
        header('Location:../index.php');
    }
    

?>








<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Payment completed successfully </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f8f9fa;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .success-card{
            max-width:550px;
            width:100%;
            border:none;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .success-icon{
            width:100px;
            height:100px;
            background:#d1fae5;
            color:#16a34a;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            font-size:50px;
        }
    </style>
</head>
<body>

<div class="card success-card">
    <div class="card-body text-center p-5">

        <div class="success-icon mb-4">
            ✓
        </div>

        <h2 class="fw-bold text-success">
            Payment completed successfully
        </h2>

        <p class="text-muted mt-3">
            Thank you for completing your purchase.
            Your payment has been successfully received and is being processed as quickly as possible.
        </p>

        <div class="d-grid gap-2 mt-4">
            <a href="../orders.php" class="btn btn-success btn-lg">
                Show Orders
            </a>

            <a href="../index.php" class="btn btn-outline-secondary">
                Home Page
            </a>
        </div>

    </div>
</div>
<?php } ?>
</body>
</html>
<?php ob_end_flush(); ?>