<?php 
session_start();
ini_set('display_errors','off');
error_reporting('E_ALL');
require_once("dbconnect.php");
if(!isset($_SESSION["id"])):
	header("location:login.php");
else:
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
	</head>
	<body>
		<?php
		$mysqli = new mysqli("localhost", "root","","db_comp_store");
		$result=mysqli_query($db, "SELECT * FROM workers");
		$result1=mysqli_query($db, "SELECT * FROM product");
		$result2=mysqli_query($db, "SELECT * FROM provider");
	//$result_auth=mysqli_query($db, "SELECT * FROM authorization");

		/* изменение набора символов на utf8 */
		if (!$mysqli->set_charset("utf8")) {
			printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);
			exit();
		} else {}

		if (mysqli_connect_errno()) { 
			echo "<p><strong>Ошибка подключения к БД</strong>. Описание ошибки: ".mysqli_connect_error()."</p>";
			exit(); 
		}

	//Добавление сотрудника
		if (isset($_POST["inser"])) {
			$firstname =$_POST['first_name']; 
			$lastname = $_POST['last_name']; 
			$birthday = $_POST['birthday'];
			$id_post = $_POST['dol']; 
			$city=$_POST['city']; 
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			if (!$mysqli->query("INSERT INTO workers (`surname_worker`, `name_worker`, `post_id`, `birthday`, `city`, `address_worker`, `phone_worker`, `e_mail_worker`) 
				VALUES ('".$lastname."', '".$firstname."', '".$id_post."','".$birthday."','".$city."','".$address."','".$phone."', '".$email."')"))
			{
				echo "Не удалось добавить: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$mysqli->query("INSERT INTO authorization (`id`,`e_mail`,`password`) VALUES ('".$mysqli->insert_id."','".$email."','".md5($password)."')"));
			else header('Location: '.'workers.php'); 
		}


	//Удаление сотрудника
		while($myrow=mysqli_fetch_array($result)){
			$temp="del".$myrow["id"];
			$temp1=$myrow["id"];
			if (isset($_POST["$temp"])) { 
				$temp="del".$myrow["id"];
				$temp1=$myrow["id"];
				$result = mysqli_query($db,"DELETE FROM workers WHERE id=$temp1");
				if($result) header('Location: '.'workers.php'); 
			} 
		}

		//$image = $_FILES['image']['tmp_name'];		
		//$image = addslashes(file_get_contents($image));
		//Добавление товара
	if (isset($_POST["inser_product"])) {
		$product_name =$_POST['product_name']; 
		$specifications = $_POST['specifications']; 
		$description = $_POST['description'];
		$provider_id=$_POST['provi'];
		$number=$_POST['number']; 
		$price_zakup=$_POST['price_zakup'];
		$price_total=$_POST['price_total'];
		if (!$mysqli->query("INSERT INTO product (`provider_id`, `product_name`, `specifications`, `description`, `price_zakup`, `number`, `price_total`) VALUES ('".$provider_id."','".$product_name."', '".$specifications."', '".$description."','".$price_zakup."','".$number."','".$price_total."')")){
			echo "Не удалось добавить: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		else header('Location: '.'product.php');
		}



			//Удаление товара
		while($myrow=mysqli_fetch_array($result1)){
			$temp="dell".$myrow["product_id"];
			$temp1=$myrow["product_id"];
			if (isset($_POST["$temp"])) { 
				$temp="del1".$myrow["product_id"];
				$temp1=$myrow["product_id"];
				$result1 = mysqli_query($db,"DELETE FROM product WHERE product_id=$temp1");
				if($result1) header('Location: '.'product.php'); 
			} 
		}


			//Добавление поставщика
		if (isset($_POST["inser_provider"])) {
			$firstname =$_POST['provider_name']; 
			$lastname = $_POST['provider_agent']; 
			$phone=$_POST['provider_phone'];
			$address=$_POST['provider_address'];
			$email=$_POST['provider_e_mail'];
			if (!$mysqli->query("INSERT INTO provider (`provider_name`, `provider_agent`, `provider_phone`, `provider_address`, `provider_e_mail`) 
				VALUES ( '".$firstname."','".$lastname."','".$phone."','".$address."', '".$email."')"))
			{
				echo "Не удалось добавить: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			else header('Location: '.'provider.php'); 
		}


		//Удаление Поставщика
		while($myrow=mysqli_fetch_array($result2)){
			$temp="del2".$myrow["provider_id"];
			$temp1=$myrow["provider_id"];
			if (isset($_POST["$temp"])) { 
				$temp="del2".$myrow["provider_id"];
				$temp1=$myrow["provider_id"];
				$result1 = mysqli_query($db,"DELETE FROM provider WHERE provider_id=$temp1");
				if($result2) header('Location: '.'provider.php'); 
			} 
		}


	//Оформление товара
		if (isset($_POST["inser_oform"])) {
			$product_uid = $_POST['product_uid'];
			$kol_vo = $_POST['kol_vo'];
			$name = $_POST['name']; 
			$surname = $_POST['surname'];
			$adres = $_POST['adres']; 
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$sot_id=$_SESSION["id"];
			if (!$mysqli->query("INSERT INTO clients (`surname`, `name`, `phone`, `e_mail`, `address`) 
				VALUES ('".$surname."', '".$name."','".$phone."', '".$email."','".$adres."')"))
			{
				echo "Не удалось добавить: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$mysqli->query("INSERT INTO orders (`product_id`,`id`,`order_date`,`client_id`,`kolvo`) VALUES ('".$product_uid."','".$sot_id."',now(), '".$mysqli->insert_id."', '".$kol_vo."')"))
			{
				echo "Не удалось добавить: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			else header('Location: '.'workers.php'); 
		}

		if (isset($_POST["logout"])) {
			session_start();
			unset($_SESSION['id']);
			session_destroy();
			header("location:login.php");
		}
		?>
	</body>
	</html>
<?php endif; ?>
