<?php
include ('./conect.php');
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $query = "DELETE FROM orders WHERE product_id = $order_id";
    mysqli_query($con, $query);

    $query1 = 'SELECT COUNT(*) as count , sum(price) as total FROM orders';
    $result = mysqli_query($con, $query1);

    $row = mysqli_fetch_assoc($result);
    header('Content-Type: application/json');
    echo json_encode([
        'count' => $row['count'],
        'total' => $row['total']
    ]);
    exit;
}
