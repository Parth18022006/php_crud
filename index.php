<?php
require_once './includes/init.php';
include pathof('includes/header.php');
?>

<head>
  <link rel="stylesheet" href="<?= urlof('assets/css/sidebar.css'); ?>">

</head>
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar d-flex flex-column align-items-start px-3">
      <div class="w-100 border-bottom pb-3 mb-3">
        <h4 class="text-white text-center w-100">Product Management</h4>
      </div>
      <a href="<?= urlof("./index.php");?>">Index page</a>
      <a href="<?= urlof("./pages/category/index.php");?>">Category</a>
      <a href="<?= urlof("./pages/product/index.php");?>">Product</a>
      <a href="<?= urlof("./api/user/logout.php"); ?>">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="col-md-9 col-lg-10 content">
        <h1 class="mb-4">Index Page</h1>
        <a href="<?= urlof('pages/category/index.php'); ?>" class="btn btn-primary me-2">CATEGORY</a>
        <a href="<?= urlof('pages/product/index.php'); ?>" class="btn btn-primary me-2">PRODUCT</a>
      </div>
    </div>
  </div>
</body>

</html>