<?php
require_once "../../includes/init.php";
include pathof('includes/header.php');


$q = "SELECT * FROM `category`";

$stmt = $conn->prepare($q);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

    <div class="col-md-9 col-lg-10 px-4">
        <br>
        <label for="">Select Category :</label>
        <select name="" id="cid">
            <?php
            foreach ($row as $r) {

            ?>
                <option value="<?= $r['c_id'] ?>">
                    <?= $r['cname'] ?>
                </option>
            <?php
            }
            ?>
        </select>
        <form method="post">
            <input type="text" name="pro" id="pro" placeholder="Enter the product">
            <input type="number" name="price" id="price" placeholder="Enter the price">
            <input type="button" value="ADD" onclick="insertproduct();">
        </form>
        <br><br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category-Id</th>
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

        let data = {
            cid: $('#cid').val(),
            pro: $('#pro').val(),
            price: $('#price').val()
        };
        console.log(data);

        $.ajax({
            url: '../../api/product/add_product.php',
            method: "POST",
            data: data,
            success: function(response) {
                alert("Product Added Successfully");
                displaypro();
            },
            error: function(error) {
                alert("Product Not Added");
            }

        });
    }

    function displaypro() {

        $.ajax({
            url: "../../api/product/display_api.php",
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
                                    <td scope="col">${response.product[i].cid}</td>
                                    <td scope="col">${response.product[i].cname}</td>
                                    <td scope="col"><a href="./update_product.php?id=${response.product[i].pid}">Update</a></td>
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
        $.ajax({
            url: "../../api/product/delete_api.php",
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

    }
</script>
</body>

</html>