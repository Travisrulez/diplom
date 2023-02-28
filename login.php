<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include("app/database.php");
error_reporting(0);
session_start();
if ($_SESSION["u_id"]) {
  header("location:account.php");
} else {
if(isset($_POST['submit']))
{
	$username = $_POST['email'];
	$password = $_POST['pass'];
	if(!empty($_POST["submit"])) 
     {
	$loginquery ="SELECT * FROM user WHERE email='$username' && password='".md5($password)."'";
	$result=mysqli_query($link, $loginquery);
	$row=mysqli_fetch_array($result);
	
	if(is_array($row))
		{
				$_SESSION["u_id"] = $row['u_id'];
					header("location:account.php");
		} 
	else
		{
				$message = "Неверное имя пользователя или пароль";
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
  <div class='page-container login'>
    <p class='title'>Вход</p>
    <div class='inputs login'>
      <div class='input-container'>
        <label class='label' for='email'>Email</label>
        <input class='input' name="email" id='email' placeholder='Введите Email' />
      </div>
      <div class='input-container'>
        <label class='label' for='password'>Пароль</label>
        <input class='input' name="pass" type='password' id='password' placeholder='Введите пароль' />
      </div>
    </div>
    <div class='buttons'>
      <input class='btn small' type="submit" name="submit" value="Вход"></input>
      <a class='btn small secondary' href='registration.php'>
        У меня нет аккаунта
      </a>
      <p style="color:red;"><?php echo $message; ?></p>
    </div>
  </div>
</div>
</form>
</body>
</html>
<?php 
}
?>