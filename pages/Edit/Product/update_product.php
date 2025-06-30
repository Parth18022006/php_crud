<?php
require_once '../../../includes/init.php';
include pathof('includes/header.php');

$url = urlof('pages/product/index');
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
            <div id="emsg" style="color: red;size: 6px;"></div>
        </form>

    </div>
</div>



<script>
    function updatepro() {

        let name = document.getElementById('pro').value;
        let price = document.getElementById('price').value;

        let ogname = <?= json_encode($pro['pname']) ?>;
        let ogpass = <?= json_encode($pro['price']) ?>;

        document.getElementById('emsg').innerHTML = "";

        if (name != null && name != "" && price != "" && price != null) {

            if (price <= 0) {
                alert("Enter Valid Price.");
                $('#price').val("");
                return;
            } else {
                let data = {
                    id: $('#id').val(),
                    pro: $('#pro').val(),
                    price: $('#price').val()
                };
                $.ajax({
                    url: "../../../api/product/update_api",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        if (ogname == data.pro && ogpass == data.price) {
                            document.getElementById('emsg').innerHTML = "<br>Oops! Their Is No Change..";
                            return false;
                        } else if (response.success != true) {
                            alert("Something Went Wrong");
                        } else {
                            alert("Product Updated");
                            window.location.href = "./index";
                        }

                    },
                    error: function(error) {
                        alert("Product Not Updated");

                    }
                });
            }
        } else {
            document.getElementById('emsg').innerHTML = "<br>Null Fields Are Not Allowed"
        }
    }
</script>

</body>

</html>