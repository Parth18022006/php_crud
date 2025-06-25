<?php
require_once '../../../includes/init.php';
include pathof('includes/header.php');
?>

<!-- Sidebar -->
<?php
include pathof('includes/sidebar.php');
?>
<div class="main-content">

    <div class="col-md-9 col-lg-10 px-4">
        <form action="" method="post">
            <br>
            <input type="text" name="cat" id="cat" placeholder="Enter The CATEGORY">
            <input type="button" value="Insert" onclick="insertcat()">
            <div id="emsg" style="color: red;size: 6px;"></div>
        </form>

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
            <a href="<?= urlof('pages/Edit/Product/index'); ?>" class="text-decoration-none text-primary fw-semibold">Product</a>
        </p>
    </div>
</div>

<script>
    $(displaycat());

    function insertcat() {

        let cat = document.getElementById('cat').value;

        document.getElementById('emsg').innerHTML = "";

        if (cat != "" && cat != null) {
            let data = {
                cat: $("#cat").val()
            }
            $.ajax({
                url: "../../../api/category/add_category",
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

        } else {
            document.getElementById('emsg').innerHTML = "<br>Category Not Entered"
        }


    }

    function displaycat() {
        $.ajax({
            url: "../../../api/category/display_api",
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
                                <td scope="col"><a href="./update_category?id=${response.category[i].c_id}">Update</a></td>
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
        let text = "Sure?You Want To Delete";
        if (confirm(text) == true) {
            $.ajax({
                url: "../../../api/category/delete_api",
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
        } else {
            window.location.href = "./index";
        }

    }
</script>