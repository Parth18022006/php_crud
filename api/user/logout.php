<?php 
session_start();
session_destroy();
header('Location: ../../pages/user/login.php');
exit;
?>