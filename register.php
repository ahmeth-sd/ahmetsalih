<?php      
    

$baglanti = mysqli_connect("localhost","root","","javatpoint");
	mysqli_set_charset($baglanti,"utf8");

	if (!$baglanti)
		echo "BAĞLANILAMADI";


	
	
	
	
	
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";
	$ad = $soyad = $eposta = "";
	$ad_err = $soyad_err = $eposta_err = "";
	
	//kullanıcı doğrulama
if ( isset($_POST['submit']) )
{
	//kullanıcı doğrulama
	if(empty(trim($_POST["username"])))
	{
		$username_err = "Kullanıcı adı kısmı boş geçilemez.";
        echo "Kullanıcı adı kısmı boş geçilemez.";
    } 
	elseif(!preg_match('/^[a-zA-Z0-9_.]+$/', trim($_POST["username"])))
	{
		$username_err = "Kullanıcı adı yalnızca harf, sayı ve alt çizgi içerebilir.";
        echo "Kullanıcı adı yalnızca harf, sayı ve alt çizgi içerebilir.";
    } 
	else
	{
        // Prepare a select statement
        $sql = "SELECT * FROM login WHERE username = ?";
        
        if($stmt = mysqli_prepare($baglanti, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
				
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
				{
					echo "Bu kullanıcı adı kullanılıyor.";
                    $username_err = "This username is already taken.";
                } 
				else
				{
					
                    $username = trim($_POST["username"]);
                }
            } 
			else
			{
                echo "404 Error";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	//Parola doğrulama
	if(empty(trim($_POST["password"])))
	{
		echo "Parola alanı boş bırakılamaz.";
        $password_err = "Please enter a password.";     
    } 
	else
	{
        $password = trim($_POST["password"]);
    }	
	if(empty(trim($_POST["ad"])))
	{
		echo "Lütfen adınızı giriniz.";
        $ad_err = "Please enter a password.";     
    } 
	else
	{
        $ad = trim($_POST["ad"]);
    }
	
	if(empty(trim($_POST["soyad"])))
	{
		echo "Lütfen soyadınızı giriniz.";
        $soyad_err = "Please enter a password.";     
    } 
	else
	{
        $soyad = trim($_POST["soyad"]);
    }	
	
	if(empty(trim($_POST["eposta"])))
	{
		echo "Lütfen e-postanızı giriniz.";
        $eposta_err = "Please enter a password.";     
    } 
	else 
	{
		$eposta = $_POST['eposta'];
		if (filter_var($eposta, FILTER_VALIDATE_EMAIL)) 
		{
			$eposta = trim($_POST["eposta"]);
		}
		else 
		{
			$eposta_err = "eposta";
			echo("Lütfen geçerli bir e-posta adresi giriniz.");
		}
        
    }
	

	
	
	
	
	
	
}




	
	
	
	  if(empty($username_err) && empty($password_err) && empty($ad_err) && empty($soyad_err) && empty($eposta_err))
	  {
		  if (count($_POST)>0)
		{
			
			$sorgu="INSERT INTO login (username, password, ad, soyad, eposta) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['ad']."','".$_POST['soyad']."','".$_POST['eposta']."')";
			$gonder = mysqli_query($baglanti, $sorgu);
			
			function function_alert($message) 
			{
      
				// Display the alert box 
				echo "<script>alert('$message');</script>";
			}
  
  
			// Function call
			function_alert("Başarıyla kayıt oldunuz");
			header("location: index.php");
			
			
		}
		
        
			
	  }
		
    // Close connection
    //mysqli_close($link);
	



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Jargonmonoksit Kayıt Ekranı
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" action = "register.php" onsubmit = "return validation()" method = "POST">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Kullanıcı Adı">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Şifre">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="ad" placeholder="Adınız">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="soyad" placeholder="Soyadınız">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="eposta" placeholder="E-mail Adresiniz">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Kayıt Ol
						</button>
					</div>
					
					<div class="container-login100-form-btn m-t-32">
						<p>Zaten üye misiniz? <a href="index.php">Giriş yapın</a>.</p>
					</div>
					

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>