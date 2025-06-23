<?php
require_once "../../includes/init.php";
include pathof('includes/header.php');
?>

<!-- Sidebar -->
<?php
        include pathof('includes/sidebar.php');
?>
        
<head>
    <link rel="stylesheet" href="<?= urlof('Admin/assets/css/adregister.css')?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<form method="post">
    <h2 class="text-center mb-4 text-gradient">Admin Registration Form</h2>
    <input type="email" name="mail" id="mail" placeholder="Enter The Mail">
    <small id="emsg1" style="color: red;"></small>

    <input type="password" name="pass" id="pass" placeholder="Enter The Password">
    <small id="emsg2" style="color: red; text-align:center ;"></small>

    <input type="password" name="cpass" id="cpass" placeholder="Enter The Confirm Password">
    <small id="emsg3" style="color: red; text-align:center ;"></small>

    <select name="role" id="role">
        <option value="Admin">Admin</option>
        <option value="User">User</option>
    </select>

    <small id="emsg" style="color: red; text-align:center ;"></small>
    <input type="button" value="Register" onclick="register()">
    <br>
</form>

<script>
    function register(){

        let mail = document.getElementById('mail').value;
        let pass = document.getElementById('pass').value;
        let cpass = document.getElementById('cpass').value;
        let user = document.getElementById('role').value;

            document.getElementById('emsg').innerHTML = "";
            document.getElementById('emsg1').innerHTML = "";
            document.getElementById('emsg2').innerHTML = "";
            document.getElementById('emsg3').innerHTML = "";

            let pmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
            let vpass = /^[0-9]{4,}$/;

        if(mail != null && mail !="" && pass != null && pass !="" && cpass != null && cpass !="" && user != null && user !=""){
            if(pmail.test(mail)){
                if(vpass.test(pass)){
                    if(pass == cpass){
                        
                        let data = {
                            mail:$('#mail').val(),
                            pass:$('#pass').val(),
                            role:$('#role').val()
                        }

                        $.ajax({
                            url:"../api/register_api.php",
                            method:"POST",
                            data:data,
                            success:function(response){
                                alert("Admin Registered Successfully");
                                window.location.href = "../../index.php";
                            },
                            error:function(error){
                                alert("Admin Not Registered");
                            }
                        })
                    }else{
                document.getElementById('emsg3').innerHTML = "Password Mismatched";
                return false;
                    }
                }else{
                document.getElementById('emsg2').innerHTML = "Password Pattern Not Matched";
                return false;
                }
            }else{
                document.getElementById('emsg1').innerHTML = "Email Pattern Not Matched";
                return false;
            }
        }else{
            document.getElementById('emsg').innerHTML = "Null Fields Not Allowed";
            return false;
        }

    }
</script>
</body>
</html>