<?php
require_once '../../includes/init.php';
include pathof('includes/header.php');

$url = urlof('pages/category/index.php');
if (!isset($_GET['id'])) {
    header("Location: $url");
}
$id = $_GET['id'] ?? null;

$q = "SELECT * FROM `category` WHERE `c_id` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$cat = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar d-flex flex-column align-items-start px-3">
        <div class="w-100 border-bottom pb-3 mb-3">
            <h4 class="text-white w-100">Product Management</h4>
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
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?= $cat['c_id'] ?>">
                <input type="text" name="cat" id="cat" placeholder="Enter The CATEGORY" value="<?= $cat['cname'] ?>">
                <input type="button" value="Update" onclick="updatecat()">
            </form>
        </div>
    </div>
</div>


<script>
    function updatecat(c_id) {

        let data = {
            id: $("#id").val(),
            cat: $("#cat").val()
        }

        $.ajax({
            url: "../../api/category/update_api.php",
            method: "POST",
            data: data,
            success: function(response) {
                if (response.success != true) {
                    alert("Something Went Wrong");
                } else {
                    window.location.href = "./index.php"
                }

            },
            error: function(error) {
                alert("Category Not Updated");
            },
        });


    }
</script>

</body>

</html>