<!DOCTYPE html>
<?php 



        
    $sql_getCurrentTime = 'SELECT * FROM showcaseTime';
    $result_getCurrentTime = $conn->query($sql_getCurrentTime);
    $fetch_getCurrentTime = $result_getCurrentTime -> fetch_all(MYSQLI_ASSOC);
    $currentTime = $fetch_getCurrentTime[0]['time'];
    $registerEcho = $_GET['registerEcho'];
    $verifityEcho = $_GET['verifityEcho'];
    $wrongPassword = $_GET['wrongPassword'];
    $existEmail = $_GET['existEmail'];
    $accountUpdate = $_GET['accountUpdate'];
    $newPassword = $_GET['newPassword'];
    $passwordNotMatch = $_GET['passwordNotMatch'];
    $currentPasswordWrong = $_GET['currentPasswordWrong'];
    $enterNewPassword = $_GET['enterNewPassword'];
    $enterCurrentPassword = $_GET['enterCurrentPassword'];
    
    if(isset($registerEcho)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>'.$registerEcho.'</strong></div>');
        }
    if(isset($verifityEcho)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>Hesap aktif değil. </strong><br><a style ="color:white;" href=../user/verify_account.php?action=sendVerificationEmail&user='.$verifityEcho.'>Aktivasyon E-Postasını gönder.</a></div>');
    }
    if(isset($wrongPassword)){
        echo ('<div class = "warn-popup"> <img src = "close.png"><strong>E-Posta veya şifre yanlış</strong><br><a style = "color:white;" href = #resetPassword>Şifre Yenile</a></div>');
    }
    if(isset($existEmail)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>'.$existEmail.' kayıtlı değil.</strong></div>');
    }
    if(isset($accountUpdate)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>Hesap Güncellendi</strong></div>');
    }
    if(isset($passwordNotMatch)){
        echo('<div class = "warn-popup"><img src = "close.png"><strong> Şifreler eşleşmiyor... </strong></div>');
    }
    if(isset($currentPasswordWrong)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>Şuanki şifre yanlış...</strong></div>');
    }

    if(isset($enterNewPassword)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>Yeni şifreyi giriniz...</strong></div>');
    }
        
    if(isset($enterCurrentPassword)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>Şuanki şifreyi giriniz...</strong></div>');
    }
    
    if(isset($newPassword)){
        echo ('<div class = "warn-popup"><img src = "close.png"><strong>Lütfen yeni şifreyi girin...</strong></div>');
    }
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>



<html lang="tr">
    
    
    
<head>
    
	<title>Admin Panel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="polyfill/html5-simple-date-input-polyfill.css" />
	<link rel= "stylesheet" href = "/polyfill/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</head>




<body>


<div class ="left-header" id = "leftHeader">
    <div id ="menuImgId" class = "menuImg"> <img id = "menuImg"  src="imgs/menu.png" style = "width:100%;height:100%"> </img> </div>
        <div class ="left-header-content" id = "leftHeaderContent" style = "text-overflow: ellipsis;">
           
                <div class = "login">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
                        <div class="username-div"  >
                            <img src = "imgs/profile.png" class = "profileImg"> 
                            <?php if (isset($_SESSION['username'])){echo '<a style = "font-weight: bold;" class = "usernamea" href = "account.php">'.$_SESSION['username'].'</a>';}?>
                        </div>
                    </div>
                    <div class = "profile-links">    
                        <img src = "imgs/logout.png" class = "logout-img">
                        <a class="logina" href="index.php?action=logout" >Logout</a>
                        <img src = "imgs/cart.png" class = "cart-img" >
                        <a class="logina" href="index.php?com=openCart">Sepet</a>
                        <img src = "imgs/cart.png" class = "cart-img">
                        <a class = "logina" href = "index.php?com=openMyOrders">Siparişlerim</a>
                        <img src = "imgs/cart.png" class ="cart-img">
                        <a class = "logina" href = "messanges.php">Mesajlarım</a>
                </div>
                <?php }else { echo '<button class ="login-link" style = "border-bottom-width:0px;" href="#">Giriş Yap</button></div>';}?>
            <div class = "left-header-buttons">
                
                <button style = "font-weight: bold;" id = "home-page" class = "anasayfa"> Ana Sayfa </button>
                
                <button style = "font-weight: bold;" id ="categories-button"> Kategoriler </button>
                
                
                
                
                
                <div class = "main-cat">
                <?php
                $sql_getMainCategories = 'SELECT * FROM mainCategories';
                $result_getMainCategories = $conn -> query($sql_getMainCategories);
                $fetch_getMainCategories = $result_getMainCategories -> fetch_all(MYSQLI_ASSOC);
                
                foreach($fetch_getMainCategories as $mainCategorie){

                    echo '<button  class = "main-cat-button" value ="'.$mainCategorie['categories'].'" style = "padding-left:10%;" hasCat="true">'.$mainCategorie['categories'].'<a class = "main-categories-get-all" value = "'.$mainCategorie['categories'].'">Git</a></button>';
                    
                    $sql_getSubCategorie = 'SELECT * FROM subCategories WHERE mainCategorie = "'.$mainCategorie['categories'].'"';
                    $result_getSubCategorie = $conn ->query($sql_getSubCategorie);
                    $fetch_getSubCategorie = $result_getSubCategorie -> fetch_all(MYSQLI_ASSOC);
                    echo '<div id = "'.$mainCategorie['categories'].'" class = "sub-cat" style = "display:none;" value ="'.$mainCategorie['categories'].'">';
                    foreach($fetch_getSubCategorie as $subCategorie){

                        echo '<button hasCat = "true" class = "sub-cat-button" style="padding-left:15%" value = "'.$subCategorie['subCategorie'].'" >'.$subCategorie['subCategorie'].'<a class = "sub-categories-get-all" value = "'.$subCategorie['subCategorie'].'">Git</a> </button>';
                        $sql_getMarkas = 'SELECT * FROM markas WHERE subCategorie = "'.$subCategorie['subCategorie'].'"';
                        $result_getMarkas = $conn->query($sql_getMarkas);
                        $fetch_getMarkas = $result_getMarkas -> fetch_all(MYSQLI_ASSOC);
                        echo '<div id = "'.$subCategorie['subCategorie'].'" class = "marka" style ="display:none;">';
                        foreach($fetch_getMarkas as $marka){
                        
                            echo '<button style = "padding-left:20%" value = "'.$marka['marka'].'" class = "marka-button">'.$marka['marka'].' </button>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
                </div>
                

                <button style = "font-weight: bold;" > İletişim </button>
            </div>
      </div>
</div>

<div class = "window">
    <img class = "login-modal-close-button" src = "../imgs/close.png">
        <div class = "card">
        <div class = "card-header" style = "text-align:center"> Giriş Yap </div>
    <div class="container pt-5 pb-4">
	<div class="row justify-content-center">
		<div class="col-12 col-md-6 col-lg-4 col-xl-3">
			<form action="user/login.php" method="post" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="username">Kullanıcı Adı veya E-Posta </label>
					<input type="text" class="form-control" id="username" placeholder="Kullanıcı Adı veya E-Posta" name="myusername" >
				</div>
				<div class="form-group">
					<label for="password">Şifre</label>
					<input type="password" class="form-control" id="password" placeholder="Şifre" name="mypass" autocomplete = = "on">
				</div>
				<button type="submit" class="btn btn-info mx-auto d-block w-100" name="submit">Giriş Yap</button>
			</form>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-md-6 col-lg-4 py-3">
			<div class="d-flex justify-content-center">
				<a id="registerBtn" class="btn btn-link" data-toggle="collapse" href="#register" role="button" aria-expanded="false" aria-controls="register">
					Kayıt Ol
				</a>
				<a id="resetBtn" class="btn btn-link" data-toggle="collapse" href="#resetPassword" role="button" aria-expanded="false" aria-controls="resetPassword">
					Şifremi Unuttum
				</a>
			</div>

			<div class="collapse mt-4" id="register">
				<div class="card">
					<div class="card-header">Yeni Kullanıcı</div>
					<div class="card-body">
						<div class="needs-validation" novalidate enctype="multipart/form-data">
							<div class="form-group">
								<label for="r_username">Kullanıcı Adı</label>
								<input type="text" class="form-control" id="r_username" placeholder="Kullanıcı Adı" name="r_username" autocomplete = "on" required>
							</div>

							<div class="form-group">
								<label for="r_email">E-Posta</label>
								<input type="email" class="form-control" id="r_email" placeholder="E-Posta" name="r_email" autocomplete ="on" required>
							</div>

							<div class="form-group">
								<label for="r_pass">Şifre </label>
								<input type="password" class="form-control" id="r_pass" placeholder="Şifre" name="r_pass" autocomplete ="on" required>
								<p class="mt-2 text-info show-pass">Şifreyi Göster</p>
							</div>

							<div class="form-group">
								<label for="r_pass_2">Şifre Tekrar</label>
								<input type="password" class="form-control" id="r_pass_2" placeholder="Şifre Tekrar" name="r_pass_2" autocomplete ="on"  required>
								<p class="mt-2 text-info show-pass">Show password</p>
							</div>

							<div class="form-group">
								<label for="r_date">Doğum Tarihi</label>
								<input type="date" class="form-control" id="r_date" name="r_dateofbirth" required>
							</div>

							<div class="form-group">
								<label for="r_photo">Fotoğraf</label>
								<input type="file" id="r_photo" name="r_photo" class="w-100" accept=".jpg, .jpeg, .png">
							</div>

							<button id ="register-submit-button" class="btn btn-warning mx-auto d-block" name="register">Kayıt Ol</button>
						</div>
					</div>
				</div>
			</div>

			<div class="collapse mt-4" id="resetPassword">
				<div class="card">
					<div class="card-header">
						Şifreyi Sıfırla
					</div>
					<div class="card-body">
						<form action="request_new_pass.php" method="post" class="needs-validation" novalidate>
							<div class="form-group">
								<label for="reset_email">E-Posta</label>
								<input type="email" class="form-control" id="reset_email" placeholder="E-Posta" name="reset_email" required>
							</div>
							<button type="submit" class="btn btn-danger mx-auto d-block" name="reset">Sıfırla</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
      
</div>
    
    
</div>

</body>



