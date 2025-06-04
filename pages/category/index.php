<?php
require_once '../../includes/init.php';
include pathof('includes/header.php');
?>

    <!-- Sidebar -->
    <?php
    include pathof('pages/sidebar.php');
    ?>

    <!-- Main Content -->
    <div class="main-content">

        <div class="col-md-9 col-lg-10 px-4">
            <!-- <form action="" method="post">
                <br>
                <input type="text" name="cat" id="cat" placeholder="Enter The CATEGORY">
                <input type="button" value="Insert" onclick="insertcat()">
            </form>
            <br><br> -->
            
            <a href="../Edit/Category/index.php" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Category-ID</th>
                        <th scope="col">Category-Name</th>
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
    
<script>
    $(displaycat());

    // function insertcat() {

    //     let data = {
    //         cat: $("#cat").val()
    //     }
    //     $.ajax({
    //         url: "../../api/category/add_category.php",
    //         method: "POST",
    //         data: data,
    //         success: function(response) {
    //             alert("Category Added");
    //             $('#cat').val("");
    //             displaycat();
    //         },
    //         error: function(error) {
    //             alert("Category Not Added");
    //         }
    //     });
    // }

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
                            </tr>
                            `
                    }
                } else {
                    record += `<tr><td colspan = "2" style="text-align:center ;">No Records</td></tr>`
                }
                $("#tbody").html(record);
            },
            error: function(error) {
                alert("Category Not Displayed");

            },
        });

    }

    // function deletecat(c_id) {
    //     $.ajax({
    //         url: "../../api/category/delete_api.php",
    //         method: "POST",
    //         data: {
    //             c_id: c_id
    //         },
    //         success: function(response) {
    //             displaycat();
    //         },
    //         error: function(error) {
    //             alert("Category Not Deleted");
    //         },
    //     });
    // }
</script>
</body>

</html>