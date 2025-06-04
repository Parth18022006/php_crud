<?php
require_once '../../../includes/init.php';
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
        </form>
    </div>
</div>


<script>
    function updatecat(c_id) {

        let data = {
            id: $("#id").val(),
            cat: $("#cat").val()
        }

        $.ajax({
            url: "../../../api/category/update_api.php",
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