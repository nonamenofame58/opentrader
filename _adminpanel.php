<?php

session_start();

include 'inc/db.php';

$formId = $_GET['id'];
$formPassword = $_GET['pw'];


$formPasswordd = PASSWORD_HASH($formPassword,PASSWORD_DEFAULT);

$conn = dbConnection();

if($conn->connect_error){die('Database Connection Failed : ' . connect_error);}




$sql = 'select * from admin where adminid = "'.$formId.'" ';
$res = $conn->query($sql);

if(isset($formId)and isset($formPassword)){
    if($res){
        $fetch = $res->fetch_assoc();
        if (password_verify($formPassword,$fetch['adminpass'])){
            $_SESSION['adminID'] = $fetch['adminid'];
            $_SESSION['adminPass'] = $fetch['adminpass'];
            echo $_SESSION['adminID'];
            echo '<script>window.location.href= "pgameart.com/admin/panel.php"</script>';
            exit();
        }else{
            echo '<script>window.loaction.href = "pgameart.com/adminpanel.php"</script>';
        }
    }
}else{
        echo '
        <html>
        <style>
        
        body{background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(58,58,101,1) 20%, rgba(0,212,255,1) 100%);
}
        .panel-login input{width:100%;border-radius:5px;border-width:1px;font-size:15px;padding:5px;text-align:center;}
        .panel-login form{margin:17px;}
        .panel-login {width:400px;border:solid 1px grey;border-radius:10px;background:rgba(0,35,125,0.3);margin:auto;margin-top:15%;color:white}
        .panel-login input[type=submit]{margin-top:20px;padding:10px;transition:1s;}
        .panel-login input[type=submit]:hover{background:rgba(16,16,16,1);transition:1s;color:white;}
        .panel-login p{text-align:center;font-size:15px;}
        </style>
        <body>
        <div class = "panel-login">
        <h2 style = "text-align:center"> Admin Panel <h2>
        <hr>
        <form>
        <p>Kullanıcı Adı</p><input type="text" name="id"></input>
        <p>Şifre</p><input type="password" name="pw"></input>
        <input type="submit" value = "Giriş">
        </form>
        </div>
        </body>
        </html>
        ';
    }




?>