<?php

require_once "../../includes/init.php";

header("Content-Type: application/json");

$id = $_POST['c_id'] ?? null;

$q = "DELETE FROM `category` WHERE `c_id` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$user = $stmt->execute($param);

if($user > 0){
    echo json_encode(['success' => true, 'message' => "User deleted"]);
}else{
    echo json_encode(['success' => false, 'message' => "User Not deleted"]);

}
?>