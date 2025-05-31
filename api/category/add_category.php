<?php

    require_once "../../includes/init.php";

    header("Content-Type: application/json");

   $cat = $_POST["cat"] ?? null;

   $q = "INSERT INTO `category`(`cname`) VALUES (?)";
   $param = [$cat];

   $stmt = $conn->prepare($q);
   $row = $stmt->execute($param);   

   if($row > 0){
    echo json_encode(['success' => true, 'message' => "Category Added"]);
   }else{
    echo json_encode(['success' => false, 'message' => "Category Not Added"]);

   }


?>