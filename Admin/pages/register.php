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
    <link rel="stylesheet" href="https://unpkg.com/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

</head>
<form method="post">
    <h2 class="text-center mb-4 text-gradient">Admin Registration Form</h2>
    <input type="email" name="mail" id="mail" placeholder="Enter The Mail">
    <small id="emsg1" style="color: red; text-align:center ;"></small>

    <div class="password-field">
    <input type="password" name="pass" id="pass" placeholder="Enter The Password">
    <i class="fa-solid fa-eye toggle-pass" data-target="pass" aria-hidden="true"></i>
    </div>
    <small id="emsg2" style="color: red; text-align:center ;"></small>

    <div class="password-field">
    <input type="password" name="cpass" id="cpass" placeholder="Enter The Confirm Password">
    <i class="fa-solid fa-eye toggle-pass" data-target="cpass" aria-hidden="true"></i>
    </div>
    <small id="emsg3" style="color: red; text-align:center ;"></small>

    <select name="role" id="role">
        <option value="" disabled selected hidden>Select role</option>
        <option value="Admin">Admin</option>
        <option value="User">User</option>
    </select>

    <small id="emsg" style="color: red; text-align:center ;"></small>
    <input type="button" value="Register" onclick="register()">
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
                            url:"../api/register_api",
                            method:"POST",
                            data:data,
                            success:function(response){
                                alert(user + "" + " Registered Successfully");
                                window.location.href = "../../index";
                            },
                            error:function(error){
                                alert(user + "" +" Not Registered");
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

    /* ④ the tiny JS toggle (put after the field or in a separate JS file) */
    document.querySelectorAll('.toggle-pass').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = document.getElementById(icon.dataset.target);
      const show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      icon.classList.toggle('fa-eye', !show);
      icon.classList.toggle('fa-eye-slash', show);
    });
  });

  const roleSel = document.getElementById('role');

/* list is about to open → hide arrow */
roleSel.addEventListener('mousedown', () => {
  roleSel.classList.add('is-open');
});

/* list just closed *and* the value changed → show arrow */
roleSel.addEventListener('change', () => {
  roleSel.classList.remove('is-open');
});

/* user pressed Esc or clicked elsewhere without changing value → show arrow */
roleSel.addEventListener('blur', () => {
  roleSel.classList.remove('is-open');
});

</script>
</body>
</html>