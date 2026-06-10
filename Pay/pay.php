<?php
session_start();
include ('../includes/conect.php');
require_once 'config.php';
require_once './config.php';
$username = $_SESSION['username'];
$query =
    "SELECT product_title, price ,count
        FROM cart
        WHERE username = '$username'";

$result = mysqli_query($con, $query);

$data = [];
$counter = 0;
$secretKey = $_ENV['STRIPE_SECRET_KEY'];

while ($row = mysqli_fetch_assoc($result)) {
    $data["line_items[$counter][price_data][currency]"] = 'usd';
    $data["line_items[$counter][price_data][product_data][name]"] = $row['product_title'];
    $data["line_items[$counter][price_data][unit_amount]"] = $row['price'] * 100;
    $data["line_items[$counter][quantity]"] = $row['count'];
    $counter++;
}
$data['mode'] = 'payment';
$data['success_url'] = 'http://localhost/success.php';
$data['cancel_url'] = 'http://localhost/GLEAM-CREAT/mycart.php';
$init = curl_init();
curl_setopt($init, CURLOPT_URL, 'https://api.stripe.com/v1/checkout/sessions');
curl_setopt($init, CURLOPT_POST, true);
curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
curl_setopt($init, CURLOPT_USERPWD, $secretKey . ':');
curl_setopt($init, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($init, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($init);
if ($response === false) {
    echo 'Error Number: ' . curl_errno($init) . '<br>';
    echo 'Error Message: ' . curl_error($init);
    exit;
}
curl_close($init);

$result = json_decode($response, true);
header('Location: ' . $result['url']);
exit;
