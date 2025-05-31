<?php
require_once './includes/init.php';

include pathof('includes/header.php');
?>
<head>
<link rel="stylesheet" href="<?=urlof('assets/css/index.css');?>">
</head>
<h1>Index page</h1>
    
    <a href="<?= urlof('pages/category/index.php'); ?>">CATEGORY</a>
    <a href="<?= urlof('pages/product/index.php'); ?>">PRODUCT</a>
    <br>
    <a href="<?= urlof('api/user/logout.php'); ?>">logout</a>
</body>

</html>

