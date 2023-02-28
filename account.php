<?php 
include("app/database.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
session_start();
if ($_SESSION["u_id"]) {
  $u_id = $_SESSION["u_id"];
  $sql = "SELECT * FROM request WHERE u_id=". $u_id;
    $result = mysqli_query($link, $sql);
    $u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport'
    content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="stylesheet" href="./styles/css/account.css">
  <title>Конференция | Личный кабинет</title>
</head>
<body>
  <div class='app'>
    <header class='header'>
      <div class='header__container container'>
        <p class='header__title'><a href="index.php" class="header__arrow">&larr;</a>Личный кабинет</p>
        <div class='header__account'>
          <p class='header__name'><?=$u['name']?></p>
          <a href="app/exit.php" class='btn small secondary'>Выход</a>
        </div>
      </div>
    </header>

    <section class='applications'>
      <div class='applications__container container'>
        <div class='application card'>
          <div class='application__name'>Заявка на участие в конференции</div>
          <div class='application__title'>Язык, сознание, комунникация</div>
          <div class='application__status'><?=$u['answer']?></div>
          <div class='application__tags'>
            <div class='application__tag'>Онлайн</div>
            <div class='application__tag'>12 ноября 2023</div>
            <div class='application__tag'>Русский</div>
            <div class='application__tag'><a href="<?=$u['phile']?>">Диплом</a></div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
</html>
<?php 
}else {
  header("location:login.php");
}
?>