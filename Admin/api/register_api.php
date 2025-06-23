<?php
header("Content-Type: application/json");

require_once "../../includes/init.php";

$mail = $_POST['mail'] ?? null;
$pass = $_POST['pass'] ?? null;
$role = $_POST['role'] ?? null;

$q = "INSERT INTO `user`(`email`, `Password`, `Role`) VALUES (?,?,?)";
$param = [$mail,$pass,$role];

$stmt = $conn->prepare($q);
$user = $stmt->execute($param);

if($user >0){
    echo json_encode(['success' => true , 'message' => "User Registered"]);
}else{
    echo json_encode(['success' => false , 'message' => "User Not Registered"]);

}
?>