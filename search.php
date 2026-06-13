<?php
include(__DIR__ . '/includes/conect.php');

if(isset($_POST['keyword'])) {
    global $con;
    $keyword = htmlspecialchars(trim($_POST['keyword']),ENT_QUOTES|ENT_SUBSTITUTE);
    $query = " SELECT * from products where product_title like '%$keyword%'";
    $res = mysqli_query($con,$query);

    $data=[];
    while($row = mysqli_fetch_assoc($res)) {
        $data[]= $row;
    }

    echo json_encode([
        'data' => $data,
        'count' => count($data)
    ]);
}