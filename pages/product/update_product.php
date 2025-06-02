<?php
require_once '../../includes/init.php';
include pathof('includes/header.php');

$url = urlof('pages/product/index.php');
if (!isset($_GET['id'])) {
    header("Location: $url");
}
$id = $_GET['id'] ?? null;

$q = "SELECT * FROM `product` WHERE `pid` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$pro = $stmt->fetch(PDO::FETCH_ASSOC);

$c_query = "SELECT * FROM `category`";
$c_stmt = $conn->prepare($c_query);
$c_stmt->execute();
$categories = $c_stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<head>
    <link rel="stylesheet" href="<?= urlof('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?= urlof('assets/css/common.css'); ?>">
</head>
<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar d-flex flex-column align-items-start px-3">
        <div class="w-100 border-bottom pb-3 mb-3">
            <h4 class="text-white text-center w-100">Product Management</h4>
        </div>
        <a href="<?= urlof("./index.php"); ?>">Index page</a>
        <a href="<?= urlof("./pages/category/index.php"); ?>">Category</a>
        <a href="<?= urlof("./pages/product/index.php"); ?>">Product</a>
        <a href="<?= urlof("./api/user/logout.php"); ?>">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="col-md-9 col-lg-10 px-4">
            <br>
            <h1>Update page</h1>

            <form method="post">

                <input type="hidden" name="id" id="id" value="<?= $pro['pid'] ?>">
                <input type="text" name="pro" id="pro" placeholder="Enter the product" value="<?= $pro['pname'] ?>">
                <input type="number" name="price" id="price" placeholder="Enter the price" value="<?= $pro['price'] ?>">
                <!-- <select id="c_id">
                <?php
                foreach ($categories as $cat) {
                ?>
                    <option value="<?= $cat['c_id'] ?>"><?= $cat['cname'] ?></option>
                <?php
                }
                ?>
            </select> -->
                <input type="button" value="Update" onclick="updatepro()">
            </form>

        </div>
    </div>
</div>



<script>
    function updatepro() {
        let data = {
            id: $('#id').val(),
            pro: $('#pro').val(),
            price: $('#price').val()
        };
        $.ajax({
            url: "../../api/product/update_api.php",
            method: "POST",
            data: data,
            success: function(response) {
                if (response.success != true) {
                    alert("Something Went Wrong");
                } else {
                    window.location.href = "./index.php";
                }

            },
            error: function(error) {
                alert("Product Not Updated");

            }
        });

    }
</script>

</body>

</html>