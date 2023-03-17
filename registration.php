<?php 
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
include("app/database.php");
session_start();
if ($_SESSION["u_id"]) {
  header("location:account.php");
} else {
if(isset($_POST['submit']))
{
     if(empty($_POST['cr_user']) ||
   	    empty($_POST['cr_email'])|| 
		empty($_POST['cr_pass']) ||  
		empty($_POST['cr_cpass']))
		{
			$message = "все поля должны быть заполнены";
		}
	else
	{
	$check_username= mysqli_query($link, "SELECT name FROM user where name = '".$_POST['cr_user']."' ");
	$check_email = mysqli_query($link, "SELECT email FROM user where email = '".$_POST['cr_email']."' ");
	if($_POST['cr_pass'] != $_POST['cr_cpass']){
       	$message = "Пароли не совпадают!";
    }
    elseif (!filter_var($_POST['cr_email'], FILTER_VALIDATE_EMAIL))
    {
       	$message = "Неверный email адрес!";
    }
	elseif(mysqli_num_rows($check_username) > 0)
     {
    	$message = 'Пользователь уже существует!';
     }
	elseif(mysqli_num_rows($check_email) > 0)
     {
    	$message = 'Пользователь с такой почтой уже существует!';
     }
	else 
		 {
			$mql = "INSERT INTO user (name,password,email,status,phone,place,birthday) VALUES ('".$_POST['cr_user']."','".md5($_POST['cr_pass'])."','".$_POST['cr_email']."','".$_POST['status']."','".$_POST['phone']."','".$_POST['place']."','".$_POST['birthday']."')";
			mysqli_query($link, $mql);
			$success = "Аккаунт успешно создан, <br> вы будете сечас будете перенаправлены на стрницу авторизации!";
      header("refresh:5;url=login.php");
		 }
    }
}
?>
<!doctype html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport'
    content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="stylesheet" href="./styles/css/login.css">
  <title>Конференция | Вход</title>
</head>
<body>
<form method="post">
  <div class='app'>
    <div class='page-container registration'>
      <p class='title'>Регистрация</p>
      <div class='inputs'>
        <div class='input-container'>
          <label class='label' for='fullname'>ФИО</label>
          <input class='input' id='fullname' placeholder='Введите ФИО' name="cr_user"/>
        </div>
        <div class='input-container'>
          <label class='label' for='status'>Статус</label>
          <input class='input' id='status' placeholder='Введите статус' name="status"/>
        </div>
        <div class='input-container'>
          <label class='label' for='dateOfBirth'>Дата рождения</label>
          <input class='input' id='dateOfBirth' placeholder='Введите дату рождения' name="birthday"/>
        </div>
        <div class='input-container'>
          <label class='label' for='email'>Email</label>
          <input class='input' type='email' id='email' placeholder='Введите Email' name="cr_email"/>
        </div>
        <div class='input-container'>
          <label class='label' for='phone'>Контактный телефон</label>
          <input class='input' id='phone' placeholder='Введите телефон' name="phone"/>
        </div>
        <div class='input-container'>
          <label class='label' for='place'>Место работы</label>
          <input class='input' id='place' placeholder='Введите место работы' name="place"/>
        </div>
        <div class='input-container'>
          <label class='label' for='password'>Пароль</label>
          <input class='input' type='password' id='password' placeholder='Введите пароль' name="cr_pass"/>
        </div>
        <div class='input-container'>
          <label class='label' for='repeat'>Повторите пароль</label>
          <input class='input' type='password' id='repeat' placeholder='Введите пароль повторно' name="cr_cpass"/>
        </div>
      </div>
      <div class='buttons'>
        <input class='btn small' type="submit" name="submit" value="Регистрация"></input>
        <a class='btn small secondary' href='login.php'>
          У меня уже есть аккаунт
        </a>
        <p style="color:red;"><?php echo $message; ?></p>
			<p style="color:green;"><?php echo $success; ?></p>
      </div>
    </div>
  </div>
</form>
</body>
</html>
<?php 
}
?>