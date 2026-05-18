<?php
include(__DIR__ . '/includes/conect.php');



if(isset($_POST['keyword'])){
    global $con;
    $key_word = htmlspecialchars(trim($_POST['keyword']),ENT_QUOTES|ENT_SUBSTITUTE);
    $query = " SELECT * from products where product_title like '%$key_word%'";
    $res = mysqli_query($con,$query);
    
    $output_a=[];
    while($row = mysqli_fetch_assoc($res)){

        $output_a[]= $row;
    }
    echo json_encode([
        'data' => $output_a,
        'count' => count($output_a)
    ]);
}





