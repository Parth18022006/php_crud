<?php
require_once '../../../includes/init.php';
include pathof('includes/header.php');

$url = urlof('pages/category/index');
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

<!-- Sidebar -->
<?php
include pathof('includes/sidebar.php');
?>

<!-- Main Content -->
<div class="main-content">
    <div class="col-md-9 col-lg-10 px-4">
        <br>
        <h1>Update page</h1>
        <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?= $cat['c_id'] ?>">
            <input type="text" name="cat" id="cat" placeholder="Enter The CATEGORY" value="<?= $cat['cname'] ?>">
            <input type="button" value="Update" onclick="updatecat()">
            <div id="emsg" style="color: red;size: 6px;"></div>
        </form>
    </div>
</div>


<script>
    function updatecat(c_id) {

        let name = document.getElementById('cat').value;
        let ogname = <?= json_encode($cat['cname'])?>;

        document.getElementById('cat').innerHTML = "";

        if (name != null && name != "") {
            let data = {
                id: $("#id").val(),
                cat: $("#cat").val()
            }

            $.ajax({
                url: "../../../api/category/update_api",
                method: "POST",
                data: data,
                success: function(response) {
                    if(ogname == data.cat){
                        document.getElementById('emsg').innerHTML = "<br>Oops! Their Is No Change..";
                        return false;
                    }
                    else if (response.success != true) {
                        alert("Something Went Wrong");
                    } else {
                        alert("Category Updated");
                        window.location.href = "./index"
                    }

                },
                error: function(error) {
                    alert("Category Not Updated");
                },
            });
        } else {
            document.getElementById('emsg').innerHTML = "<br>Category Not Entered"
        }
    }
</script>

</body>

</html>