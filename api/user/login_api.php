<?php

require_once "../../includes/init.php";

header("Content-Type: application/json");

$mail = $_POST["email"] ?? null;
$password = $_POST["password"] ?? null;

$q = "SELECT * FROM `user` WHERE `email` = ? and `Password` = ?";
$params = [$mail, $password];


$stmt = $conn->prepare($q);
$stmt->execute($params);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
    echo json_encode(['success' => true, 'user' => $user]);
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user['id'];
}
else{
    echo json_encode(['success' => false]);
}



?>