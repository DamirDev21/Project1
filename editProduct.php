<?php 
session_start();
require_once("dbconnect.php");
if(!isset($_SESSION["id"])):
  header("location:login.php");
else:
if(isset($_POST['update']))
{	
	$product_id = mysqli_real_escape_string($db,$_POST['product_id']);
	$product_name =mysqli_real_escape_string($db,$_POST['product_name']);
	$specifications =mysqli_real_escape_string($db, $_POST['specifications']); 
  $provider_id=mysqli_real_escape_string($db, $_POST['provider_id']);
	$description =mysqli_real_escape_string($db, $_POST['description']);
	$number =mysqli_real_escape_string($db, $_POST['number']); 
	$price_zakup =mysqli_real_escape_string($db, $_POST['price_zakup']); 
	$price_total =mysqli_real_escape_string($db, $_POST['price_total']); 

	$result = mysqli_query($db, "UPDATE product SET product_name='$product_name' WHERE product_id=$product_id");

	$result1 = mysqli_query($db, "UPDATE product SET specifications='$specifications' WHERE product_id=$product_id");

	$result2 = mysqli_query($db, "UPDATE product SET description='$description' WHERE product_id=$product_id");

  $result3 = mysqli_query($db, "UPDATE product SET provider_id='$provider_id' WHERE product_id=$product_id");

  $result4 = mysqli_query($db, "UPDATE product SET `number`='$number' WHERE product_id=$product_id");

  $result5 = mysqli_query($db, "UPDATE product SET price_zakup='$price_zakup' WHERE product_id=$product_id");
  $result6 = mysqli_query($db, "UPDATE product SET price_total='$price_total' WHERE product_id=$product_id");
	//header("location: index.php");
}
else
{
	$product_id = $_GET['id'];
	$result = mysqli_query($db, "SELECT * FROM product WHERE product_id=$product_id");

	while($myrow = mysqli_fetch_array($result))
	{
		$product_name=$myrow['product_name'];
		$specifications=$myrow['specifications'];
		$description=$myrow['description'];
    $provider_id=$myrow['provider_id'];
    $number=$myrow['number'];
    $price_zakup=$myrow['price_zakup'];
    $price_total=$myrow['price_total'];
  }
}
?>

<html>
<head>	
	<title>Редактирование</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  <style>
  input.form-style{
    color:#8a8a8a;
    display: block;
    width: 100%;}
    .return{
      margin-left: 20px;
    }
  </style>
</head>
<body>
  <div id="form">
    <form action="editProduct.php" method="POST">
      <h2>Изменить</h2>
      <div class="form-item">
        <input type="text" name="product_name" class="form-style" id="product_name" value="<?php echo $product_name;?>"/>
      </div>
      <div class="form-item">
        <input type="text" name="specifications" class="form-style" id="specifications" value="<?php echo $specifications;?>"/>
      </div>
      <div class="form-item">
        <input type="text" name="description" class="form-style" id="description" value="<?php echo $description;?>"/>
      </div>
      <label for="styledSelect1" class="custom-select">
        <select name="provider_id" id="styledSelect1">
         <option value="0">Поставщик</option>
         <?php
         $res=mysqli_query($db, "SELECT * FROM provider");
         while($row = mysqli_fetch_array($res)){
          echo '<option value="'.$row["provider_id"].'">'.$row["provider_name"].'</option>';
        }
        ?>
      </select>
    </label> 
    <br>
    <div class="form-item">
      <input type="text" name="number" id="number" class="form-style" value="<?php echo $number;?>"/>
    </div>
    <div class="form-item">
      <input type="text" name="price_zakup" id="price_zakup" class="form-style" value="<?php echo $price_zakup;?>"/>
    </div>
    <div class="form-item">
      <input type="text" name="price_total" id="price_total" class="form-style" value="<?php echo $price_total;?>"/>
    </div>
    <div class="question">
      <input type="hidden" name="product_id" value=<?php if(!isset($_POST['update'])) echo $_GET['id'];?>>
      <input type="submit" class="return" value=" Обновить " name="update"/>
      <a href="product.php" class="return">Назад</a><br>
    </div>
  </form>
</div>
</body>
</html>
<?php endif; ?>