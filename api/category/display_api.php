<?php

require_once "../../includes/init.php";

header("Content-Type: application/json");

$q = "SELECT *  FROM `category`";

$stmt = $conn->prepare($q);
$stmt->execute();

$category = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($category != null){
    echo json_encode(['success' => true, 'category' => $category]);
}else{
    echo json_encode(['success' => false, 'message' => "Data Not displayed"]);

}
?>