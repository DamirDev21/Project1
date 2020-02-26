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
			height:16px;
		}
		table th{
			text-align: center;
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
			<a href="workers.php" class="hvr-grow" >СОТРУДНИКИ</a>
			<a href="order.php" >ПРОДАЖИ</a>
			<a href="provider.php" >ПОСТАВЩИКИ</a> 
			<!-- <div class="navbar"></div> -->
		</nav>
		<input  type="text" class="poisk"  id="search" placeholder="Поиск" />
	</div>

	<div class="container-table100">
		<div class="wrap-table100">
			<div class="table100">	
				<form action="action.php" method="POST">
					<?php
					$result=mysqli_query($db, "SELECT * FROM workers INNER JOIN posts ON workers.post_id=posts.post_id");

	//Таблица
					echo '<table id="myTable" class="tablesorter">
					<thead>
					<tr class="table100-head">
					<th>#</th>
					<th>Фамилия</th>
					<th>Имя</th>
					<th>Должность</th>
					<th>День рождения</th>
					<th>Город</th>
					<th>Адрес</th>
					<th>Номер телефона</th>
					<th>Email</th>
					<th colspan="2">Операции</th>
					</tr>
					</thead>';

	//вывод таблицы
					echo '<tbody>';
					while($myrow=mysqli_fetch_array($result)){
						echo '<tr id="myElement">';
						echo '<td id="ser'.$myrow["id"].'">'.$myrow["id"].'
						</td>';
						echo '<td>'.$myrow["surname_worker"].'</td>';
						echo '<td>'.$myrow["name_worker"].'</td>';
						echo '<td>'.$myrow["post_name"].'</td>';
						echo '<td>'.$myrow["birthday"].'</td>';
						echo '<td>'.$myrow["city"].'</td>';
						echo '<td>'.$myrow["address_worker"].'</td>';
						echo '<td id="phnNum">'.$myrow["phone_worker"].'</td>';
						echo '<td>'.$myrow["e_mail_worker"].'</td>';
						echo "<td><a href=\"edit.php?id=$myrow[id]\" class=\"edited\">Изменить</a></td>";
						echo '<td><input type="submit" class="delete" name="del'.$myrow["id"].'" value="Удалить"></td>';
						echo '</tr>';
					}
					echo '<tbody>';

	// Добавление записи
					echo '<tr>
					<td  id="insert_sot" colspan="11"><a href="insert.php" class="link_insert">Добавить</a></td>
					</tr>';
					echo '</table>';
					while($myrow=mysqli_fetch_array($result)){
						$temp="num".$myrow["id"];
						$temp1=$myrow["id"];
						if (isset($_POST["$temp"])) { 
							$result = mysqli_query($db,"DELETE FROM workers WHERE idr=$temp1");
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