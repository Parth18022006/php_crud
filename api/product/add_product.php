<?php

require_once '../../includes/init.php';

header("Content-Type: application/json");

$pro = $_POST['pro'] ?? null;
$price = $_POST['price'] ?? null;
$cid = $_POST['cid'] ?? null;


$q = "INSERT INTO `product`(`pname`, `price`,`cid`) VALUES (?,?,?)";
$param = [$pro,$price,$cid];

$stmt = $conn->prepare($q);
$product = $stmt->execute($param);

if($product > 0){
    echo json_encode(['success' => true , 'message' => "Added successfully"]);
}else{
    echo json_encode(['success' => false , 'message' => "Not added"]);

}

?>