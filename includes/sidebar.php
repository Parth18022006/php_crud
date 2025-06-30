<div class="col-md-3 col-lg-2 sidebar d-flex flex-column align-items-start px-3">
  <div class="w-100 border-bottom pb-3 mb-3">
    <h4 class="text-white w-100">Product Management</h4>
  </div>
  <a href="<?= urlof("./index"); ?>">Dashboard</a>
  <a href="<?= urlof("./pages/category/index"); ?>">Category</a>
  <a href="<?= urlof("./pages/product/index"); ?>">Product</a>
  <a href="<?= urlof("./api/user/logout"); ?>" class="logout" onclick="return confirm('Sure! You Want To Logout.');">Logout</a>
</div>