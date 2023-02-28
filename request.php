<!doctype html>
<html lang='en'>
<?php 
include("app/database.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if ($_SESSION["u_id"]) {
  $u_id = $_SESSION["u_id"];
if(isset($_POST['submit'])) {
    $fname = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fsize = $_FILES['file']['size'];
    $extension = explode('.',$fname);
    $extension = strtolower(end($extension));  
    $fnew = uniqid().'.'.$extension;
    $store = "assets/docs/".basename($fnew);                  
    if($extension == 'pdf'||$extension == 'doc'||$extension == 'docx') {        
        if ($fsize>=1000000) {
            $error = 	'<div class="modal error">
                            Максимальный размер изображения 1 Mb!
                        </div>';
        } else {
            $sql = "INSERT INTO request(name, title, status, birthday, email, phone, pages, director, place, phile) VALUE('".$_POST['name']."','".$_POST['title']."','".$_POST['status']."','".$_POST['birthday']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['pages']."','".$_POST['director']."','".$_POST['place']."','".$fnew."')";
            mysqli_query($link, $sql); 
            move_uploaded_file($temp, $store);

            $success = 	'<div class="modal success">
                            Запись успешно добавлена!
                        </div>';
        }
    } elseif ($extension == '') {
        $error = 	'<div class="modal error">
                        Необходимо выбрать изображение!
                    </div>';
    } else {
        $error = 	'<div class="modal error">
                        Допустимые форматы изображения: PNG, JPEG, GIF!
                    </div>';
    }
    // $_SESSION['error'] = $error;
    // $_SESSION['success'] = $success;
    header("location:account.php");
}
$sql = "SELECT * FROM user WHERE u_id=". $u_id;
    $result = mysqli_query($link, $sql);
    $u = mysqli_fetch_assoc($result);
?>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport'
    content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="stylesheet" href="./styles/css/style.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> -->
  <!-- <script src="scripts/wow.js" defer></script> -->
  <!-- <script src="scripts/modal.js" defer></script> -->
  <title>Конференция</title>
</head>
<body>
  <header class='header'>
    <div class='header__container container'>
      <a href="index.php" class="header__arrow">&larr;</a><h1 class='header__title h1'>Язык, сознание, коммуникация</h1>
      <a href="login.php" class='header__btn btn'>
        <img src='assets/icons/user.svg' />
      </a>
    </div>
  </header>
  <div class='overlay'></div>
  <div class='modal'>
    <form method='post' enctype="multipart/form-data">
      <div class='modal__title'>Подача заявки</div>
      <div class='modal__inputs'>
        <div class='input-container'>
          <label class='label' for='fullname'>ФИО</label>
          <input class='input' id='fullname' name="name" placeholder='Введите ФИО' value="<?=$u['name']?>"/>
        </div>
        <div class='input-container'>
          <label class='label' for='status'>Статус</label>
          <input class='input' id='status' name="status" placeholder='Введите статус' value="<?=$u['status']?>"/>
        </div>
        <div class='input-container'>
          <label class='label' for='dateOfBirth'>Дата рождения</label>
          <input class='input' id='dateOfBirth' name="birthday" placeholder='Введите дату рождения' value="<?=$u['birthday']?>"/>
        </div>
        <div class='input-container'>
          <label class='label' for='email'>Email</label>
          <input class='input' type='email' name="email" id='email' placeholder='Введите Email' value="<?=$u['email']?>"/>
        </div>
        <div class='input-container'>
          <label class='label' for='phone'>Контактный телефон</label>
          <input class='input' id='phone' name="phone" placeholder='Введите контектный телефон' value="<?=$u['phone']?>"/>
        </div>
        <div class='input-container'>
          <label class='label' for='articleTitle'>Название статьи</label>
          <input class='input' id='articleTitle' name="title" placeholder='Введите название статьи' />
        </div>
        <div class='input-container'>
          <label class='label' for='director'>Научный руководитель</label>
          <input class='input' id='director' name="director" placeholder='Введите руководителя' />
        </div>
        <div class='input-container'>
          <label class='label' for='pageSize'>Кол-во страниц</label>
          <input class='input' type='number' name="pages" id='pageSize' placeholder='Введите кол-во страниц' />
        </div>
        <div class='input-container'>
          <label class='label' for='place'>Место работы</label>
          <input class='input' id='place' name="place" placeholder='Введите место работы' value="<?=$u['place']?>"/>
        </div>
        <div class='input-container'>
          <label class='label' for='file'>Поле прикрепления файла</label>
          <input class='input' type='file' name="file" id='file' placeholder='asd' />
        </div>
      </div>

      <input class='modal__btn btn' type='submit' name='submit' value="Подать заявку"></input>
    </form>
  </div>
</body>
</html>
<?php 
}else {
  header("location:login.php");
}
?>