<!doctype html>
<html lang='en'>
<?php 
include("app/database.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// error_reporting(0);
session_start();
if ($_SESSION["u_id"]) {
  $u_id = $_SESSION["u_id"];
  // echo $u_id;
  $ssql = "SELECT * FROM request WHERE u_id=". $u_id;
$cresult = mysqli_query($link, $ssql);
$creq = mysqli_num_rows($cresult);
if ($creq ==0) {
if(isset($_POST['submit'])) {
  $documents = $_FILES['documents'];
  $ssql = "INSERT INTO request(name, title, status, birthday, email, phone, pages, director, place, u_id) VALUE('".$_POST['name']."','".$_POST['title']."','".$_POST['status']."','".$_POST['birthday']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['pages']."','".$_POST['director']."','".$_POST['place']."','".$u_id."')";
            mysqli_query($link, $ssql); 
            $last_id = mysqli_insert_id($link);
	foreach ($documents['name'] as $key => $name) {
		$type = $documents['type'][$key];
		$size = $documents['size'][$key];
		$tmp_name = $documents['tmp_name'][$key];
		$error = $documents['error'][$key];
		if ($error !== UPLOAD_ERR_OK) {
			echo "Ошибка загрузки файла: " . $name;
			continue;
		}
		$allowed_formats = array('doc', 'docx', 'pdf', 'jpg', 'jpeg', 'png');
		$file_info = pathinfo($name);
		$file_ext = strtolower($file_info['extension']);
    $wrongextx = in_array($file_ext, $allowed_formats);
		if (!$wrongextx) {
			$wrongext = "Ошибка: неверный формат файла: " . $name;
      // echo $wrongext;
			// continue;
		} else {
		$new_file_name = uniqid('', true) . '.' . $file_ext;
		$upload_dir = "assets/docs/";
		if (!file_exists($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}
		$upload_file_path = $upload_dir . $new_file_name;
		if (!move_uploaded_file($tmp_name, $upload_file_path)) {
			echo "Ощибка загрузки файла: " . $name;
			continue;
		}
		$sql = "INSERT INTO files (name, type, size, path, uid, r_id) VALUES ('$name', '$type', '$size', '$upload_file_path', '$u_id', '$last_id')";
		if ($link->query($sql) !== TRUE) {
			echo "Ошибка: " . $sql . "<br>" . $link->error;
			continue;
		}}
    if (!$wrongextx) {
      mysqli_query($link, "DELETE FROM request WHERE r_id = '".$last_id."'");
      // echo $last_id;
      echo $wrongext;
    } else {
      header("location:account.php");
    }
	}
    // $_SESSION['error'] = $error;
    // $_SESSION['success'] = $success;
    // header("location:account.php");
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
          <label class='label' for='file'>Поле прикрепления файла<small>(.doc, .docx, .pdf, .jpg, .jpeg, .png)</small></label>
          <input class='input' type="file" name="documents[]" multiple id='file' placeholder='asd'/>
        </div>
      </div>

      <input class='modal__btn btn' type='submit' name='submit' value="Подать заявку"></input>
    </form>
  </div>
</body>
</html>
<?php 
}else {
  header("location:account.php");
}
}else {
  header("location:login.php");
}
?>