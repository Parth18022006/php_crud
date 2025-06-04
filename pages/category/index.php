<?php
require_once '../../includes/init.php';
include pathof('includes/header.php');
?>

<!-- Sidebar -->
<?php
include pathof('includes/sidebar.php');
?>

<!-- Main Content -->
<div class="main-content">
    <div class="col-md-9 col-lg-10 px-4">

        <a href="../Edit/Category/index.php" class="btn btn-primary">
            <i class="bi bi-pencil-square"></i>
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
</script>
</body>

</html>