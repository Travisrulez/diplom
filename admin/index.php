<!DOCTYPE html>
<html lang="en" >
<?php
include("../app/database.php");
session_start();
if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(!empty($_POST["submit"])) 
     {
	$loginquery ="SELECT * FROM admin WHERE username='$username' && password='".md5($password)."'";
	$result=mysqli_query($link, $loginquery);
	$row=mysqli_fetch_array($result);
	
	if(is_array($row))
		{
				$_SESSION["adm_id"] = $row['adm_id'];
					header("refresh:1;url=requests.php");
		} 
	else
		{
				$message = "Неверное имя пользователя или пароль";
		}
	 }
}
if(isset($_POST['submit1'] ))
{
     if(empty($_POST['cr_user']) ||
   	    empty($_POST['cr_email'])|| 
		empty($_POST['cr_pass']) ||  
		empty($_POST['cr_cpass']) ||
		empty($_POST['code']))
		{
			$message = "ALL fields must be fill";
		}
	else
	{
	$check_username= mysqli_query($db, "SELECT username FROM admin where username = '".$_POST['cr_user']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM admin where email = '".$_POST['cr_email']."' ");
	$check_code = mysqli_query($db, "SELECT adm_id FROM admin where code = '".$_POST['code']."' ");
	if($_POST['cr_pass'] != $_POST['cr_cpass']){
       	$message = "Password not match";
    }
    elseif (!filter_var($_POST['cr_email'], FILTER_VALIDATE_EMAIL))
    {
       	$message = "Invalid email address please type a valid email!";
    }
	elseif(mysqli_num_rows($check_username) > 0)
     {
    	$message = 'username Already exists!';
     }
	elseif(mysqli_num_rows($check_email) > 0)
     {
    	$message = 'Email Already exists!';
     }
	 if(mysqli_num_rows($check_code) > 0)
             {
                   $message = "Unique Code Already Redeem!";
             }
	else{
       $result = mysqli_query($db,"SELECT id FROM admin_codes WHERE codes =  '".$_POST['code']."'");  //query to select the id of the valid code enter by user! 
			if(mysqli_num_rows($result) == 0)
				{
					$message = "invalid code!";
				} 
			else 
				{
						$mql = "INSERT INTO admin (username,password,email,code) VALUES ('".$_POST['cr_user']."','".md5($_POST['cr_pass'])."','".$_POST['cr_email']."','".$_POST['code']."')";
					mysqli_query($db, $mql);
						$success = "Admin Added successfully!";
				}
        }
	}
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/css/index.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
		<h1>Панель менеджнера</h1>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Пользователь">
			<input type="password" name="password" placeholder="Пароль">
			<input type="submit" name="submit" value="Войти">
			<p style="color:red;"><?php echo $message; ?></p>
			<p style="color:green;"><?php echo $success; ?></p>
        </form>
        
    </div>
</body>
</html>