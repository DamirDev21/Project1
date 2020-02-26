<?php 
session_start();
require_once("dbconnect.php");
if(!isset($_SESSION["id"])):
	header("location:login.php");
else:
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Добавление записи</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<style>
		a{
			cursor: default;
		}
	</style>
</head>
<body>
	<div id="form">
		<form action="action.php" method="POST">
			<h2>Оформление</h2>
			<label for="styledSelect1" class="custom-select">
				<select name="product_uid" id="styledSelect1">
					<option value="0">Выберите </option>
					<?php
					$res=mysqli_query($db, "SELECT * FROM product");
					while($row = mysqli_fetch_array($res)){
						echo '<option value="'.$row["product_id"].'">'.$row["product_name"].'</option>';
					}
					?>
				</select>
			</label> 
			<br>
				<div class="form-item">
				<p class="formLabel">Количество</p>
				<input type="text" name="kol_vo" id="kol_vo" required="required"class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Имя клиента</p>
				<input type="text" name="name" id="name" required="required"class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Фамилия клиента</p>
				<input type="text" name="surname" id="surname" required="required"  class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Адрес</p>
				<input type="text" name="adres" id="adres" required="required"  class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Номер телефона</p>
				<input type="tel" name="phone" id="phone" required="required"  class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Email</p>
				<input type="email" name="email" id="email" required="required"  class="form-style"/>
			</div>
			<!-- <div class="form-item">
				<p class="formLabel"></p>
				<input type="email" name="price" id="price" required="required" placeholder="Цена:"  class="form-style" disabled/>
			</div> -->
			<input type="submit" value=" Оформить " class="btn" name="inser_oform" />
			<a href="product.php" class="return">Отмена</a>
			<!-- <a href="workers.php" class="return">На главную</a><br> -->
		</form>
	</div>
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
<?php endif; ?>