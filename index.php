<?php
require_once './includes/init.php';
include pathof('includes/header.php');
?>

<!-- Sidebar -->
<?php
include pathof('pages/sidebar.php');
?>

<!-- Main Content -->
<div class="main-content">
  <div class="col-md-9 col-lg-10 content">
    <h1 class="mb-4">Dashboard</h1>
    <a href="<?= urlof('pages/category/index.php'); ?>" class="btn btn-primary me-2">CATEGORY</a>
    <a href="<?= urlof('pages/product/index.php'); ?>" class="btn btn-primary me-2">PRODUCT</a>
  </div>
</div>
</body>

</html>