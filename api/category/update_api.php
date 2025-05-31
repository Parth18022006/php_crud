<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";



$id = $_POST['id'] ?? null;
$cat = $_POST['cat'] ?? null;

if($id and $cat){

    $q = "UPDATE `category` SET `cname`= ? WHERE `c_id` = ?";
    $param = [$cat,$id];

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