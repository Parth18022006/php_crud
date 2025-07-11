<?php
require_once '../../includes/init.php';
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
    <link rel="stylesheet" href="<?= urlof('assets/css/newl.css');?>">
    <link rel="stylesheet" href="https://unpkg.com/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">



</head >

<body>
    <form method="POST">
        <h2 class="text-center mb-4 text-theme">Login Form</h2>
        <input type="email" name="email" id="email" placeholder="Enter the Email">
        <small id="emsg1" style="color: red; text-align:center ;"></small>
        
        <div class="password-field">
        <input type="password" name="password" id="password" placeholder="Enter the Password">
        <small id="emsg2" style="color: red; text-align:center ;"></small>
        <i class="fa-solid fa-eye toggle-pass" data-target="password" aria-hidden="true"></i>
        </div>
        <small id="emsg" style="color: red; text-align:center ;"></small>
        <input type="button" value="Login" onclick="login();">
        <p class="mt-3 text-center">
            Have you Registered?
            <a href="./registration" class="text-decoration-none text-primary fw-semibold">Register</a>
        </p>
    </form>

</body>
<script>
    function login() {
        let mail = document.getElementById('email').value;
        let pass = document.getElementById('password').value;

        document.getElementById('emsg').innerHTML = "";
        document.getElementById('emsg1').innerHTML = "";
        document.getElementById('emsg2').innerHTML = "";


        let pmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
        let vpass = /^[0-9]{4,}$/;

        if (mail != "" && mail != null && pass != "" && pass != null) {
            if (pmail.test(mail)) {
                if (vpass.test(pass)) {
                    let data = {
                        email: $("#email").val(),
                        password: $("#password").val()
                    }
                    console.log(data);
                    $.ajax({
                        url: "../../api/user/login_api",
                        method: "POST",
                        data: data,
                        success: function(response) {
                            if(response.success){
                                alert("Login Successfully");
                                window.location.href = '../../index';
                                $('#email').val("");
                                $("#password").val("");
                            }else{
                                if(response.reason === "email"){
                                    document.getElementById('emsg1').innerHTML = "User With This E-mail Not Registered";
                                }else if(response.reason === "password"){
                                    document.getElementById('emsg2').innerHTML = "Incorrect Password";
                                }
                            }
                        },
                        error: function(error) {
                            alert("Not LoggedIn");
                            window.location.href = "./login";
                        }
                    });

                } else {
                    document.getElementById('emsg2').innerHTML = "Password Pattern Not Matched";
                    return false;

                }
            } else {
                document.getElementById('emsg1').innerHTML = "E-Mail Pattern Not Matched";
                return false;
            }
        } else {
            document.getElementById('emsg').innerHTML = "Null Field Not Allowed";
            return false;
        }



    }

    document.querySelectorAll('.toggle-pass').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = document.getElementById(icon.dataset.target);
      const show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      icon.classList.toggle('fa-eye', !show);
      icon.classList.toggle('fa-eye-slash', show);
    });
  });
</script>

</html>