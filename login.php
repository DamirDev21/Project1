<?php
session_start();
require_once("dbconnect.php");

if(isset($_SESSION['id'])){
	// вывод "Session is set"; // в целях проверки
	header("Location: workers.php");
}
?>
<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Form Design</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/header.css">
	<script src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
	<style>
		.nav1{
			width:100%;
			margin-left: -8px;
			margin-top:-8px;
		}
	</style>
</head>
<body>
	<div class="nav1">
		<nav>
			<a href="product.php" class="hvr-grow">ТОВАРЫ</a>
			<!-- <a href="workers.php"  >СОТРУДНИКИ</a> -->
			<!-- <a href="order.php" >ПРОДАЖИ</a> -->
			<!-- <a href="provider.php" >ПОСТАВЩИКИ</a>  -->
			<!-- <div class="navbar"></div> -->
		</nav>
	</div>
		<div id="form">
			<form action="login.php" method="POST">
				<div class="logo">
					<p class="logo1">Logo</p>
				</div>
				<div class="form-item">
					<p class="formLabel">Email</p>
					<input type="email" name="email" id="email" class="form-style" autocomplete="off"/>
				</div>
				<div class="form-item">
					<p class="formLabel">Password</p>
					<input type="password" name="password" id="password" class="form-style" />
					<!-- <div class="pw-view"><i class="fa fa-eye"></i></div> -->
				</div>
				<div class="form-item">
					<input type="submit" name="login" class="btn" value="Log In">
					<div class="clear-fix"></div>
				</div>
			</form>
		</div>
	</div>

	<?php 
	if (isset($_POST['login'])) {
		if (empty($_POST['email'])) {
			$info_input = 'Вы не ввели логин';}
		elseif (empty($_POST['password'])) {
			$info_input = 'Вы не ввели пароль';
		}else {    
			$email = $_POST['email'];
			$password = md5($_POST['password']);            
			$user = mysqli_query($db, "SELECT * FROM authorization WHERE e_mail = '$email' AND password = '$password'");
			$id_user = mysqli_fetch_array($user);
			if (empty($id_user['id'])) {
				$info_input = 'Введенные данные не верны';
			}else {
				$_SESSION['id'] = $id_user['id']; 
				$info_input = 'Вы успешно вошли в систему';     
				header("location:product.php");    
			}     
		}
	}
	$info_input = isset($info_input) ? $info_input : NULL;
	echo $info_input;
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			var formInputs = $('input[type="email"],input[type="password"],input[type="text"],input[type="tel"]');
			formInputs.focus(function() {
				$(this).parent().children('p.formLabel').addClass('formTop');
				$('div#formWrapper').addClass('darken-bg');
				$('div.logo').addClass('logo-active');
			});
			formInputs.focusout(function() {
				if ($.trim($(this).val()).length == 0){
					$(this).parent().children('p.formLabel').removeClass('formTop');
				}
				$('div#formWrapper').removeClass('darken-bg');
				$('div.logo').removeClass('logo-active');
			});
			$('p.formLabel').click(function(){
				$(this).parent().children('.form-style').focus();
			});
		});
	</script>

</body>
</html>
