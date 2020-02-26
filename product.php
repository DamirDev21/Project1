<?php 
session_start();
require_once("dbconnect.php");
if(!isset($_SESSION["id"])):
	header("location:product_us.php");
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
		<title>Товары</title>
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
		.hvr-grow{
			color:#FE002E;
		}
		#sat1 {
			text-align:center;
		}
		#insert_sot{
			text-align:center;
			height:16px;
		}
		/* Галерея*/
		.thumbnail {
			padding: 0 0 15px 0;
			border: none;
			border-radius: 0;
		}

		img {
			width: 70px;
			height: 50px
			margin-bottom: 10px;
		}
		img[tabindex="0"] {
			cursor: zoom-in;
		}
		img[tabindex="0"]:focus {
			position: fixed;
			z-index: 10;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			width: auto;
			height: auto;
			max-width: 70%;
			max-height: 70%;
			margin: auto;
			box-shadow: 0 0 20px #000, 0 0 0 1000px rgba(33,33,33,.4);
		}
		img[tabindex="0"]:focus,  /* убрать строку, если не нужно, чтобы при клике на увеличенное фото, оно возвращалось в исходное состояние */
		img[tabindex="0"]:focus ~ * {
			pointer-events: none;
			cursor: zoom-out;
		}
		table {
			width: 100%;
			table-layout: fixed;
			margin-top: 80PX;
		}
		table td {
			width: 25%;
			font-size: 14px;
			line-height: 15px;
			height: 15px;
			padding: 10px 0;
		}
		.table1 { position: relative;}
		table td>div div {
			padding: 10px;
			display: block;
			position: absolute;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			width: 100%;
			box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-o-box-sizing: border-box;
			-moz-box-sizing: border-box;
		}
		table td>div div:hover {
			white-space: normal;
			z-index: 1;

		}
		.th1{
			width:15%;
			text-align: center;
		}

		.td1{
			text-align: center;
		}
		.th2{
			text-align: center;
		}
		.th3{
			text-align: center;
			width: 50px;
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
			<a href="product.php" class="hvr-grow">ТОВАРЫ</a>
			<a href="workers.php"  >СОТРУДНИКИ</a>
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
				$result=mysqli_query($db, "SELECT * FROM product");

	//Таблица
				echo '<table id="myTable" class="tablesorter">
				<thead>
				<tr class="table100-head">
				<th class="th3">#</th>
			<!-- <th class="th2">Фото</th> -->
				<th>Название</th>
				<th class="th1">Характеристика</th>
				<th class="th1">Описание</th>
				<th class="th2">Цена</th>
				<th class="th2">Количество</th>
				<th class="th2"colspan="3">Операции</th>
				</tr>
				</thead>';

	//вывод таблицы
				echo '<tbody>';
				while($myrow=mysqli_fetch_array($result)){
					echo '<tr>';
					echo '<td>'.$myrow["product_id"].'</td>';
				//	echo '<div class="thumbnail"><td class="td1"><img src="data:image/png;base64,'.base64_encode($myrow["image"]).'" tabindex="0"></td></div>';
					echo '<td class="td1">'.$myrow["product_name"].'</td>';
					echo '<td><div><div class="table1">'.$myrow["specifications"].'</div></div></td>';
					echo '<td><div><div class="table1">'.$myrow["description"].'<div><div></td>';
					echo '<td class="td1">'.$myrow["price_total"].'</td>';
					echo '<td class="td1">'.$myrow["number"].'</td>';
					echo "<td><a href=\"sale.php?id=$myrow[product_id]\" class=\"buy\">Оформить</a></td>";
					echo "<td><a href=\"editProduct.php?id=$myrow[product_id]\" class=\"edited\">Изменить</a></td>";
					echo '<td><input type="submit" name="dell'.$myrow["product_id"].'" class="delete"  value="Удалить"></td>';
					echo '</tr>';
				}
				echo '<tbody>';
	// Добавление записи
				echo '<tr>
				<td  id="insert_sot" colspan="9"><a href="insProduct.php" class="link_insert">Добавить</a></td>
				</tr>';
				echo '</table>';
				mysqli_close($db);
				?>
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