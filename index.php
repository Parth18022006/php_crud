<?php
require_once './includes/init.php';
include pathof('includes/header.php');
?>

<!-- Sidebar -->
<?php
include pathof('includes/sidebar.php');
?>

<!-- Main Content -->
<div class="main-content">
  <div class="col-md-9 col-lg-10 content">
    <h1 class="mb-4">Dashboard</h1>
    <a href="<?= urlof('pages/category/index.php'); ?>" class="btn btn-primary me-2" style="background-color: #007bff;">CATEGORY</a>
    <a href="<?= urlof('pages/product/index.php'); ?>" class="btn btn-primary me-2"  style="background-color: #007bff;">PRODUCT</a>
    <a href="<?= urlof('Admin/pages/register.php'); ?>" class="btn btn-primary me-2"  style="background-color: #007bff;">Add Admin</a>
  </div>
</div>
</body>

</html>