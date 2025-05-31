<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$q = "SELECT product.*, category.cname FROM `product` INNER JOIN `category` on product.cid = category.c_id";

$stmt = $conn->prepare($q);
$stmt->execute();

$product = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($product != null){
    echo json_encode(['success' => true, 'product' => $product]);
}else{
    echo json_encode(['success' => false, 'message' => "Data Not Displayed"]);

}
?>