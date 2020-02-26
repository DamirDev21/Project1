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
		<title>Добавление товара</title>
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
			<h2>Добавить товар</h2>
			<div class="form-item">
				<p class="formLabel">Название</p>
				<input type="text" name="product_name" id="product_name" required="required" value="" class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Характеристики</p>
				<input type="text" name="specifications" id="specifications" required="required"  class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Описание</p>
				<input type="text" name="description" id="description" required="required"  class="form-style"/>
			</div>
			<label for="styledSelect1" class="custom-select">
				<select name="provi" id="styledSelect1">
					<option value="0">Поставщик</option>
					<?php
					$res=mysqli_query($db, "SELECT * FROM provider");
					while($row = mysqli_fetch_array($res)){
						echo '<option value="'.$row["provider_id"].'">'.$row["provider_name"].'</option>';
					}
					?>
				</select>
			</label><br>
			<div class="form-item">
				<p class="formLabel">Количество</p>
				<input type="text" name="number" id="number" required="required"  class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">Закупочная цена</p>
				<input type="text" name="price_zakup" id="price_zakup" required="required"  class="form-style"/>
			</div>
			<div class="form-item">
				<p class="formLabel">цена</p>
				<input type="text" name="price_total" id="price_total" required="required"  class="form-style"/>
			</div>
<!-- 			<label>Фото</label>
<input type="file" name="image" id="image"><br/><br /> -->
			<div class="">
				<input type="submit" class="btn" value=" Добавить " name="inser_product"/>
				<a href="product.php" class="return">На главную</a><br>
			</div>
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