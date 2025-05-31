<?php
header("Content-Type: application/json");

require_once "../../includes/init.php";


$id = $_POST['pid'];

$q = "DELETE FROM `product` WHERE `pid` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$pro = $stmt->execute($param);

if($pro > 0){
    echo json_encode(['success' => true , 'message' => "Product Deleted"]);
}else{
    echo json_encode(['success' => false , 'message' => "Product Not Deleted"]);

}
?>