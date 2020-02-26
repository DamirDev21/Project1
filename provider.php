<?php 
session_start();
require_once("dbconnect.php");
if(!isset($_SESSION["id"])):
	header("location:login.php");
else:
	$uid=$_SESSION["id"];
	$user_res = mysqli_query($db, "SELECT surname_worker,name_worker FROM workers WHERE id ='$uid' ");
	while($mrow = mysqli_fetch_array($user_res)){
		$user_surname=$mrow['surname_worker'];
		$user_name=$mrow['name_worker'];
	}
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Сотрудники</title>
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nanum+Pen+Script" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<link rel='stylesheet prefetch' href='https://github.com/IanLunn/Hover/blob/master/css/hover-min.css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/tablesorter/jquery-latest.js"></script>
		<script type="text/javascript" src="js/tablesorter/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="js/search.js"></script>
		<style>
		#insert_sot{
			text-align:center;
			margin: 0px auto;
			height:16px;
		}
		table th{
			text-align: center;
		}
		table td{
			text-align: center;
			padding-left: 10px;
			padding-right: 10px;
		}
		.hvr-grow{
			color:#FE002E;
		}
	</style>
</head>
<body>
	<div class="nav1">
		<form action="action.php" class="formout" method="POST">
			<ul class=hr>
				<li>
					<span class="users" title="Имя сотрудника"><?php echo $user_name.' '.$user_surname?>	</span>
				</li>
				<li>
					<input type="submit" name="logout" class="logout"  value="Выйти">
				</li>
			</ul>
		</form>
		<nav>
			<a href="product.php">ТОВАРЫ</a>
			<a href="workers.php"  >СОТРУДНИКИ</a>
			<a href="order.php" >ПРОДАЖИ</a>
			<a href="provider.php" class="hvr-grow" >ПОСТАВЩИКИ</a> 
			<!-- <div class="navbar"></div> -->
		</nav>
		<input  type="text" class="poisk"  id="search" placeholder="Поиск" />
	</div>

	<div class="container-table100">
		<div class="wrap-table100">
			<div class="table100">	
				<form action="action.php" method="POST">
					<?php
					$result=mysqli_query($db, "SELECT * FROM provider");

	//Таблица
					echo '<table id="myTable" class="tablesorter">
					<thead>
					<tr class="table100-head">
					<th>#</th>
					<th>Провайдер</th>
					<th>Представитель</th>
					<th>Телефон</th>
					<th>Адрес</th>
					<th>Email</th>
					<th colspan="2">Операции</th>
					</tr>
					</thead>';

	//вывод таблицы
					echo '<tbody>';
					while($myrow=mysqli_fetch_array($result)){
						echo '<tr id="myElement">';
						echo '<td>'.$myrow["provider_id"].'</td>';
						echo '<td>'.$myrow["provider_name"].'</td>';
						echo '<td>'.$myrow["provider_agent"].'</td>';
						echo '<td>'.$myrow["provider_phone"].'</td>';
						echo '<td>'.$myrow["provider_address"].'</td>';
						echo '<td>'.$myrow["provider_e_mail"].'</td>';
						echo "<td><a href=\"edit.php?id=$myrow[provider_id]\" class=\"edited\">Изменить</a></td>";
						echo '<td><input type="submit" class="delete" name="del2'.$myrow["provider_id"].'" value="Удалить"></td>';
						echo '</tr>';
					}
					echo '<tbody>';

	// Добавление записи
					echo '<tr>
					<td  id="insert_sot"colspan="8"><a href="insProvider.php" class="link_insert">Добавить</a></td>
					</tr>';
					echo '</table>';
					while($myrow=mysqli_fetch_array($result)){
						$temp="num".$myrow["provider_id"];
						$temp1=$myrow["provider_id"];
						if (isset($_POST["$temp"])) { 
							$result = mysqli_query($db,"DELETE FROM product WHERE idr=$temp1");
						} 
					}


					mysqli_close($db);
					?>
					<!-- Сортировка -->
					<script>
						$(document).ready(function(){
							$("#myTable").tablesorter();
						});
					</script>


				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php endif; ?>