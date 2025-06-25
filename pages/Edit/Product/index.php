<?php
require_once "../../../includes/init.php";
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
        <br>
        <label for="">Select Category :</label>
        <select name="cid" id="cid">
            <?php
            if (count($row) > 0) {
                foreach ($row as $r) {
            ?> <option value="<?= $r['c_id'] ?>">
                        <?= $r['cname'] ?>
                    </option>
                <?php
                }
            } else {
                ?>
                <option value="">No Records</option>
            <?php
            }


            ?>


        </select>
        <form method="post">
            <input type="text" name="pro" id="pro" placeholder="Enter the product">
            <input type="number" name="price" id="price" placeholder="Enter the price">
            <input type="button" value="ADD" onclick="insertproduct();">
            <div id="emsg" style="color: red;size: 6px;"></div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category-Name</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="tbody">


            </tbody>
        </table>

    </div>
</div>





<script>
    $(displaypro());

    function insertproduct() {

        let name = document.getElementById('pro').value;
        let price = document.getElementById('price').value;
        let cid = document.getElementById('cid').value;

        document.getElementById('emsg').innerHTML = "";

        if (name != "" && name != null && price != "" && price != null && cid != "" && cid != null) {
            let data = {
                cid: $('#cid').val(),
                pro: $('#pro').val(),
                price: $('#price').val()
            };

            $.ajax({
                url: '../../../api/product/add_product',
                method: "POST",
                data: data,
                success: function(response) {
                    alert("Product Added Successfully");
                    $('#pro').val("");
                    $('#price').val("");
                    displaypro();
                },
                error: function(error) {
                    alert("Product Not Added");
                }

            });
        } else {
            document.getElementById('emsg').innerHTML = "<br>Null Fields Are Not Allowed";
        }


    }

    function displaypro() {

        $.ajax({
            url: "../../../api/product/display_api",
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
                                    <td scope="col"><a href="./update_product?id=${response.product[i].pid}">Update</a></td>
                                    <td scope="col"><a href="" onclick="deletepro(${response.product[i].pid})">Delete</a></td>
                                    </tr>
                                    `
                    }
                } else {
                    record += `<tr><td colspan = "6" style="text-align:center ;"> No Records</td></tr>`
                }

                $("#tbody").html(record);

            },
            error: function(error) {
                alert("Product Not Displayed");

            }

        });


    }

    function deletepro(pid) {
        let text = "Sure?You Want To Delete";
        if (confirm(text) == true) {
            $.ajax({
                url: "../../../api/product/delete_api",
                method: "POST",
                data: {
                    pid: pid
                },
                success: function(response) {
                    displaypro();
                },
                error: function(error) {
                    alert("Product Not Deleted");
                }
            });
        } else {
            window.location.href = "./index";
        }

    }
</script>
</body>

</html>