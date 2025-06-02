<?php
require_once '../../includes/init.php';
include pathof('includes/header.php');
?>


<head>
    <link rel="stylesheet" href="<?= urlof('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?= urlof('assets/css/common.css'); ?>">
</head>
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
            <form action="" method="post">
                <br>
                <input type="text" name="cat" id="cat" placeholder="Enter The CATEGORY">
                <input type="button" value="Insert" onclick="insertcat()">
            </form>
            <br><br>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Category-ID</th>
                        <th scope="col">Category-Name</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="tbody">


                </tbody>
            </table>

            <p class="mt-3 text-center">
                Wanna View?
                <a href="<?= urlof('pages/product/index.php'); ?>" class="text-decoration-none text-primary fw-semibold">Product</a>
            </p>
        </div>
    </div>
</div>


<script>
    $(displaycat());

    function insertcat() {

        let data = {
            cat: $("#cat").val()
        }
        $.ajax({
            url: "../../api/category/add_category.php",
            method: "POST",
            data: data,
            success: function(response) {
                alert("Category Added");
                $('#cat').val("");
                displaycat();
            },
            error: function(error) {
                alert("Category Not Added");
            }
        });
    }

    function displaycat() {
        $.ajax({
            url: "../../api/category/display_api.php",
            method: "POST",
            success: function(response) {
                let record = "";

                if (response.category && response.category.length > 0) {
                    for (let i = 0; i < response.category.length; i++) {

                        record +=
                            `
                            <tr>
                                <td scope="col">${response.category[i].c_id}</td>
                                <td scope="col">${response.category[i].cname}</td>
                                <td scope="col"><a href="./update_category.php?id=${response.category[i].c_id}">Update</a></td>
                                <td scope="col"><a href="" onclick="deletecat(${response.category[i].c_id})">Delete</a></td>
                            </tr>
                            `
                    }
                } else {
                    record += `<tr><td colspan = "4" style="text-align:center ;">No Records</td></tr>`
                }
                $("#tbody").html(record);
            },
            error: function(error) {
                alert("Category Not Displayed");

            },
        });

    }

    function deletecat(c_id) {
        $.ajax({
            url: "../../api/category/delete_api.php",
            method: "POST",
            data: {
                c_id: c_id
            },
            success: function(response) {
                displaycat();
            },
            error: function(error) {
                alert("Category Not Deleted");
            },
        });
    }
</script>
</body>

</html>