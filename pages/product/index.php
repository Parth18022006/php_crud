<?php
require_once "../../includes/init.php";
include pathof('includes/header.php');


$q = "SELECT * FROM `category`";

$stmt = $conn->prepare($q);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!-- Sidebar -->
<?php
include pathof('includes/sidebar.php');
?>

<!-- Main Content -->
<div class="main-content">
    <div class="col-md-9 col-lg-10 px-4">

        <div style="margin-bottom: 10px;">
        <a href="../Edit/Product/index" class="btn btn-primary">
            <i class="bi bi-pencil-square"></i>
        </a>
        </div>
        

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category-Name</th>
                </tr>
            </thead>
            <tbody id="tbody">


            </tbody>
        </table>

    </div>
</div>





<script>
    $(displaypro());

    function displaypro() {

        $.ajax({
            url: "../../api/product/display_api",
            method: "POST",
            success: function(response) {
                let record = "";

                if (response.product && response.product.length > 0) {
                    for (let i = 0; i < response.product.length; i++) {
                        record +=
                            `
                                <tr>
                                    <td scope="col">${response.product[i].pid}</td>
                                    <td scope="col">${response.product[i].pname}</td>
                                    <td scope="col">${response.product[i].price}</td>
                                    <td scope="col">${response.product[i].cname}</td>
                                    </tr>
                                    `
                    }
                } else {
                    record += `<tr><td colspan = "4" style="text-align:center ;"> No Records</td></tr>`
                }

                $("#tbody").html(record);

            },
            error: function(error) {
                alert("Product Not Displayed");

            }

        });


    }

</script>
</body>

</html>