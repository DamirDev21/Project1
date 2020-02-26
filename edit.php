<?php 
session_start();
require_once("dbconnect.php");
if(!isset($_SESSION["id"])):
  header("location:login.php");
else:

  if(isset($_POST['update']))
  {	
   $id = mysqli_real_escape_string($db,$_POST['id']);
   $firstname =mysqli_real_escape_string($db,$_POST['firstname']);
   $lastname =mysqli_real_escape_string($db, $_POST['lastname']); 
   $birthday =mysqli_real_escape_string($db, $_POST['birthday']);
   $dol =mysqli_real_escape_string($db, $_POST['dol']); 
   $city =mysqli_real_escape_string($db, $_POST['city']); 
   $address =mysqli_real_escape_string($db, $_POST['address']); 
   $phone =mysqli_real_escape_string($db, $_POST['phone']);
   $email =mysqli_real_escape_string($db, $_POST['email']);

   $result = mysqli_query($db, "UPDATE workers SET surname_worker='$lastname' WHERE id=$id");

   $result1 = mysqli_query($db, "UPDATE workers SET name_worker='$firstname' WHERE id=$id");

   $result2 = mysqli_query($db, "UPDATE workers SET birthday='$birthday' WHERE id=$id");

   $result3 = mysqli_query($db, "UPDATE workers SET post_id='$dol' WHERE id=$id");

   $result3 = mysqli_query($db, "UPDATE workers SET city='$city' WHERE id=$id");
   $result4 = mysqli_query($db, "UPDATE workers SET address_worker='$address' WHERE id=$id");
   $result5 = mysqli_query($db, "UPDATE workers SET phone_worker='$phone' WHERE id=$id");
   $result6 = mysqli_query($db, "UPDATE workers SET e_mail_worker='$email' WHERE id=$id");
	//header("location: index.php");
 }
 else
 {
   $id = $_GET['id'];
   $result = mysqli_query($db, "SELECT * FROM workers WHERE id=$id");

   while($myrow = mysqli_fetch_array($result))
   {
    $firstname=$myrow['name_worker'];
    $lastname=$myrow['surname_worker'];
    $birthday=$myrow['birthday'];
    $dol=$myrow['post_id'];
    $city=$myrow['city'];
    $address=$myrow['address_worker'];
    $phone=$myrow['phone_worker'];
    $email=$myrow['e_mail_worker'];
  }
}
?>
<html>
<head>	
	<title>Редактирование</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			"use strict";
        //================ Проверка email ==================

        //регулярное выражение для проверки email
        var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
        var mail = $('input[name=email]');

        mail.blur(function(){
        	if(mail.val() != ''){

                // Проверяем, если введенный email соответствует регулярному выражению
                if(mail.val().search(pattern) == 0){
                    // Убираем сообщение об ошибке
                    $('#valid_email_message').text('');

                    //Активируем кнопку отправки
                    $('input[type=submit]').attr('disabled', false);
                  }else{
                    //Выводим сообщение об ошибке
                    $('#valid_email_message').text('Не правильный Email');

                    // Дезактивируем кнопку отправки
                    $('input[type=submit]').attr('disabled', true);
                  }
                }else{
                	$('#valid_email_message').text('Введите Ваш email');
                }
              });

        //================ Проверка длины пароля ==================
        var password = $('input[name=password]');

        password.blur(function(){
        	if(password.val() != ''){

                //Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
                if(password.val().length < 6){
                    //Выводим сообщение об ошибке
                    $('#valid_password_message').text('Минимальная длина пароля 6 символов');

                    // Дезактивируем кнопку отправки
                    $('input[type=submit]').attr('disabled', true);

                  }else{
                    // Убираем сообщение об ошибке
                    $('#valid_password_message').text('');

                    //Активируем кнопку отправки
                    $('input[type=submit]').attr('disabled', false);
                  }
                }else{
                	$('#valid_password_message').text('Введите пароль');
                }
              });
      });
    </script>
    <style>
    input.form-style{
      color:#8a8a8a;
      display: block;
      width: 100%;}
    </style>
  </head>
  <body>
  	<div id="form">
      <form action="edit.php" method="POST">
        <h2>Редактировать</h2>
        <div class="form-item">
          <input type="text" name="firstname" id="firstname" class="form-style" value="<?php echo $firstname;?>"/>
        </div>
        <div class="form-item">
          <input type="text" name="lastname" id="lastname" class="form-style" value="<?php echo $lastname;?>"/>
        </div>        
        <input type="date" name="birthday" id="birthday" class="form-style" value="<?php echo $birthday;?>"/><br>
        <label for="styledSelect1" class="custom-select">
          <select name="dol" id="styledSelect1">
            <option value="0">Выберите должность</option>
            <?php
            $res=mysqli_query($db, "SELECT * FROM posts");
            while($row = mysqli_fetch_array($res)){
              echo '<option value="'.$row["post_id"].'">'.$row["post_name"].'</option>';
            }
            ?>
          </select>
        </label> 
        <br>
        <div class="form-item">
          <input type="text" name="city" id="city" class="form-style" value="<?php echo $city;?>"/>
        </div>
        <div class="form-item">
          <input type="text" name="address" id="address" class="form-style" value="<?php echo $address;?>"/>
        </div>
        <div class="form-item">
          <input type="tel" name="phone" id="phone" class="form-style" value="<?php echo $phone;?>"/>
        </div>
        <div class="form-item">
          <input type="email" name="email" id="email" class="form-style" value="<?php echo $email;?>"/>
        </div>
        <div class="question">
          <input type="hidden" name="id" value=<?php if(!isset($_POST['update'])) echo $_GET['id'];?>>
          <input type="submit" class="btn" value=" Обновить " name="update"/>
          <a href="workers.php" class="return">Назад</a><br>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<?php endif; ?>