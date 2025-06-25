<?php
    require_once "../../includes/init.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= urlof('assets/css/register.css');?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">


</head>

<body>
    
    
    <form method="post">
        <h2 class="text-center mb-4 text-gradient">Registration Form</h2>
        <input type="email" name="mail" id="mail" placeholder="Enter The Mail">
        <small id="emsg1" style="color: red; text-align:center ;"></small>

        <input type="password" name="pass" id="pass" placeholder="Enter The Password">
        <small id="emsg2" style="color: red; text-align:center ;"></small>

        <input type="password" name="cpass" id="cpass" placeholder="Enter The Confirm Password">
        <small id="emsg3" style="color: red; text-align:center ;"></small>
        <br><small id="emsg" style="color: red; text-align:center ;"></small>
        <input type="button" value="Insert" onclick="register()">
        <br><br>
        <p class="mt-3 text-center">
             Already registered? 
           <a href="./login" class="text-decoration-none text-primary fw-semibold">Login</a>
        </p>

    </form>

    <script>
        function register() {
            let mail = document.getElementById('mail').value;
            let password = document.getElementById("pass").value;
            let cpassword = document.getElementById("cpass").value;

            document.getElementById('emsg').innerHTML = "";
            document.getElementById('emsg1').innerHTML = "";
            document.getElementById('emsg2').innerHTML = "";
            document.getElementById('emsg3').innerHTML = "";

            let pmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
            let vpass = /^[0-9]{4,}$/;

            if (mail != "" && mail != null && password != "" && password != null && cpassword != "" && cpassword != null) {
                if (pmail.test(mail)) {
                    if (vpass.test(password)) {
                        if (password == cpassword) {

                            let data = {
                                mail: $('#mail').val(),
                                pass: $('#pass').val(),
                            };

                            $.ajax({
                                url: "../../api/user/register_api",
                                method: "POST",
                                data: data,
                                success: function(response) {
                                    alert("Registration Done Successfully");
                                    window.location.href = "./login";
                                },
                                error: function(error) {
                                    alert("Not Registered");

                                }
                            });
                        } else {
                            document.getElementById('emsg3').innerHTML = "Password Mismatched";
                            return false;
                        }
                    } else {
                        document.getElementById('emsg2').innerHTML = "Password Pattern Not Matched";
                        return false;
                    }
                } else {
                    document.getElementById('emsg1').innerHTML = "Email Pattern Not Matched";
                    return false;
                }
            } else {
                document.getElementById('emsg').innerHTML = "Null Field Not Allowed";
                return false;
            }
        }
    </script>
</body>
</html>