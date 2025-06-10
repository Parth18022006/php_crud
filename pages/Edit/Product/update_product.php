<?php
require_once '../../../includes/init.php';
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


<!-- Sidebar -->
<?php
include pathof('includes/sidebar.php');
?>

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



<script>
    function updatepro() {
        let data = {
            id: $('#id').val(),
            pro: $('#pro').val(),
            price: $('#price').val()
        };
        $.ajax({
            url: "../../../api/product/update_api.php",
            method: "POST",
            data: data,
            success: function(response) {
                if (response.success != true) {
                    alert("Something Went Wrong");
                } else {
                    alert("Product Updated");
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