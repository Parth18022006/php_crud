<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";



$id = $_POST['id'] ?? null;
$pro = $_POST['pro'] ?? null;
$price= $_POST['price'] ?? null;


if($id and $pro and $price){

    $q = "UPDATE `product` SET `pname`=?,`price`=?WHERE `pid`=?";
    $param = [$pro,$price,$id];

    $stmt = $conn->prepare($q);
    $row = $stmt->execute($param);

    if($row > 0){
        echo json_encode(['success' => true, 'message' => "Data Updated"]);
    }else{
        echo json_encode(['success' => false, 'message' => "Data Not Updated"]);
    }
}else{
    echo json_encode(['success' => false, 'message' => "User Not Found"]);
}


?>