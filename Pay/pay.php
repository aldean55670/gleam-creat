<?php
session_start();
include ('../includes/conect.php');
require 'vendor/autoload.php';
$username = $_SESSION['username'];
$query =
        "SELECT product_title, price ,count
        FROM cart
        WHERE username = '$username'";

$result = mysqli_query($con, $query);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => $row['product_title'],
            ],
            'unit_amount' => $row['price'] * 100,
        ],
        'quantity' => $row['count'],
    ];
}
\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

try {
    $session = \Stripe\Checkout\Session::create([
        'line_items' => $data,
        'mode' => 'payment',
        'success_url' => 'http://localhost/success.php',
        'cancel_url' => 'http://localhost/GLEAM-CREATE/mycart.php',
    ]);

    header('Location: ' . $session->url);
} catch (\Stripe\Exception\ApiConnectionException $e) {
    ?>
    
    <!DOCTYPE html>
    <html lang="ar">
    <head>
        <meta charset="UTF-8">
        <title>خطأ</title>

        <style>
            body{
                margin:0;
                height:100vh;
                display:flex;
                justify-content:center;
                align-items:center;
                background:#f5f5f5;
                font-family:Arial;
            }

            .error-box{
                width:420px;
                background:#fff;
                padding:30px;
                border-radius:15px;
                text-align:center;
                box-shadow:0 0 15px rgba(0,0,0,.1);
            }

            .error-icon{
                font-size:60px;
                color:#ff4d4d;
            }

            .error-title{
                font-size:26px;
                margin:15px 0;
                color:#222;
            }

            .error-text{
                color:#666;
                line-height:1.8;
                margin-bottom:25px;
            }

            .btn{
                display:inline-block;
                padding:12px 25px;
                background:#000;
                color:#fff;
                text-decoration:none;
                border-radius:8px;
                transition:.3s;
            }

            .btn:hover{
                background:#333;
            }
        </style>
    </head>

    <body>

        <div class="error-box">

            <div class="error-icon">⚠️</div>

            <div class="error-title">
                فشل الاتصال
            </div>

            <div class="error-text">
                يوجد مشكلة في الاتصال بالإنترنت أو بخدمة الدفع حالياً.<br>
                حاول مرة أخرى بعد قليل.
            </div>

            <a href="../mycart.php" class="btn">
                الرجوع للسلة
            </a>

        </div>

    </body>
    </html>

    <?php
}
?>
