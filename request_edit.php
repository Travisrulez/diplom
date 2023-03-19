<!doctype html>
<html lang='en'>
<?php 
include("app/database.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
session_start();
if ($_SESSION["u_id"]) {
  $u_id = $_SESSION["u_id"];
  // echo $u_id;
  $ssql = "SELECT * FROM request WHERE u_id=". $u_id;
$cresult = mysqli_query($link, $ssql);
$creq = mysqli_num_rows($cresult);
$sssql = "SELECT * FROM user WHERE u_id=". $u_id;
    $uresult = mysqli_query($link, $sssql);
    $us = mysqli_fetch_assoc($uresult);
    $req_id = $_GET['req_id'];
    $sql = "SELECT * FROM user WHERE u_id=". $u_id;
        $result = mysqli_query($link, $sql);
        $u = mysqli_fetch_assoc($result);
    $sssssql = "SELECT * FROM request WHERE r_id=". $req_id;
        $result = mysqli_query($link, $sssssql);
        $req = mysqli_fetch_assoc($result);
// if ($creq ==0) {
if(isset($_POST['submit'])) {
  $documents = $_FILES['documents'];
  if ($_POST['file'] !== 0) {
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
		if (!in_array($file_ext, $allowed_formats)) {
			echo "Ошибка: неверный формат файла: " . $name;
			continue;
		}
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
		$sql = "INSERT INTO files (name, type, size, path, uid, r_id) VALUES ('$name', '$type', '$size', '$upload_file_path', '$u_id', '$req_id')";
		if ($link->query($sql) !== TRUE) {
			echo "Ошибка: " . $sql . "<br>" . $link->error;
			continue;
		} 
	}
  $ssql = "UPDATE request SET `name` = '$_POST[name]', title = '$_POST[title]', `status` = '$_POST[status]', birthday = '$_POST[birthday]', email = '$_POST[email]', phone = '$_POST[phone]', pages = '$_POST[pages]', director = '$_POST[director]', place = '$_POST[place]' WHERE r_id = '$_GET[req_id]'";
  // $ssql = "UPDATE request SET name = '".$_POST['name']."', title = '".$_POST['title']."', status = '".$_POST['status']."', birthday = '".$_POST['birthday']."', email = '".$_POST['email']."', phone = '".$_POST['phone']."', pages = '".$_POST['pages']."', director = '".$_POST['director']."', place = '".$_POST['place']."' WHERE r_id = '".$req_id."'";

    // $ssql = "INSERT INTO request(name, title, status, birthday, email, phone, pages, director, place, u_id) VALUE('".$_POST['name']."','".$_POST['title']."','".$_POST['status']."','".$_POST['birthday']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['pages']."','".$_POST['director']."','".$_POST['place']."','".$u_id."')";
            mysqli_query($link, $ssql);
            echo mysqli_error($link);
    // $_SESSION['error'] = $error;
    // $_SESSION['success'] = $success;
    header("location:request_edit.php?req_id=$req_id");
}
else {
  $ssql = "UPDATE request SET `name` = '$_POST[name]', title = '$_POST[title]', `status` = '$_POST[status]', birthday = '$_POST[birthday]', email = '$_POST[email]', phone = '$_POST[phone]', pages = '$_POST[pages]', director = '$_POST[director]', place = '$_POST[place]' WHERE r_id = '$_GET[req_id]'";
  // $ssql = "UPDATE request SET name = '".$_POST['name']."', title = '".$_POST['title']."', status = '".$_POST['status']."', birthday = '".$_POST['birthday']."', email = '".$_POST['email']."', phone = '".$_POST['phone']."', pages = '".$_POST['pages']."', director = '".$_POST['director']."', place = '".$_POST['place']."' WHERE r_id = '".$req_id."'";

    // $ssql = "INSERT INTO request(name, title, status, birthday, email, phone, pages, director, place, u_id) VALUE('".$_POST['name']."','".$_POST['title']."','".$_POST['status']."','".$_POST['birthday']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['pages']."','".$_POST['director']."','".$_POST['place']."','".$u_id."')";
            mysqli_query($link, $ssql);
            echo mysqli_error($link);
    // $_SESSION['error'] = $error;
    // $_SESSION['success'] = $success;
    header("location:request_edit.php?req_id=$req_id");}
}
?>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport'
    content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel="stylesheet" href="./styles/css/account.css">
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
        <p class='header__title'><a href="account.php" class="header__arrow">&larr;</a><?=$req['title']?></p>
        <div class='header__account'>
          <p class='header__name'><?=$us['name']?></p>
          <a href="app/exit.php" class='btn small secondary'>Выход</a>
        </div>
      </div>
    </header>
  <!-- <header class='header'>
    <div class='header__container container'>
      <a href="index.php" class="header__arrow">&larr;</a><h1 class='header__title h1'>Язык, сознание, коммуникация</h1>
      <a href="login.php" class='header__btn btn'>
        <img src='assets/icons/user.svg' />
      </a>
    </div>
  </header> -->
  <div class='overlay'></div>
  <div class='modal'>
    <form method='post' enctype="multipart/form-data">
      <div class='modal__title'>Информация о заявке</div>
      <div class='modal__inputs'>
        <div class='input-container'>
          <?php 
          if ($req['answer'] == 0) {
            $readeonly = ' ';
            $style = ' ';
          } else {
            $readeonly = 'readonly style="color: gray!important;"';
            $style = 'style="display:none;"';
          }
          ?>
          <label class='label' for='fullname'>ФИО</label>
          <input class='input' id='fullname' name="name" placeholder='Введите ФИО' value="<?=$req['name']?>" readonly style="color: gray!important;"/>
        </div>
        <div class='input-container'>
          <label class='label' for='status'>Статус</label>
          <input class='input' id='status' name="status" placeholder='Введите статус' value="<?=$req['status']?>" readonly style="color: gray!important;"/>
        </div>
        <div class='input-container'>
          <label class='label' for='dateOfBirth'>Дата рождения</label>
          <input class='input' id='dateOfBirth' name="birthday" placeholder='Введите дату рождения' value="<?=$req['birthday']?>" readonly style="color: gray!important;"/>
        </div>
        <div class='input-container'>
          <label class='label' for='email'>Email</label>
          <input class='input' type='email' name="email" id='email' placeholder='Введите Email' value="<?=$req['email']?>" readonly style="color: gray!important;"/>
        </div>
        <div class='input-container'>
          <label class='label' for='phone'>Контактный телефон</label>
          <input class='input' id='phone' name="phone" placeholder='Введите контектный телефон' value="<?=$req['phone']?>" readonly style="color: gray!important;"/>
        </div>
        <div class='input-container'>
          <label class='label' for='articleTitle'>Название статьи</label>
          <input class='input' id='articleTitle' name="title" placeholder='Введите название статьи' value="<?=$req['title']?>" <?=$readeonly?>/>
        </div>
        <div class='input-container'>
          <label class='label' for='director'>Научный руководитель</label>
          <input class='input' id='director' name="director" placeholder='Введите руководителя' value="<?=$req['director']?>" <?=$readeonly?>/>
        </div>
        <div class='input-container'>
          <label class='label' for='pageSize'>Кол-во страниц</label>
          <input class='input' type='number' name="pages" id='pageSize' placeholder='Введите кол-во страниц' value="<?=$req['pages']?>" <?=$readeonly?>/>
        </div>
        <div class='input-container'>
          <label class='label' for='place'>Место работы</label>
          <input class='input' id='place' name="place" placeholder='Введите место работы' value="<?=$u['place']?>" value="<?=$req['place']?>" readonly style="color: gray!important;"/>
        </div>
        <div class='input-container' <?=$style?>>
          <label class='label' for='file'>Добавить документы<small>(.doc, .docx, .pdf)</small>:</label>
          <input class='input' type="file" name="documents[]" multiple id='file' placeholder='asd' <?=$readeonly?>/>          
        </div>
        <div class='input-container'>
          <label class='label' for='file'>Мои документы:</label>
          <!-- <input class='input' type="file" name="documents[]" multiple id='file' placeholder='asd'/> -->
          <?php 
          $_SESSION["rid"] = $req_id;
          $sql11 = "SELECT * FROM files WHERE r_id=". $req_id;
          $rfile = mysqli_query($link, $sql11);
          // $rfile = mysqli_fetch_assoc($result1);
          foreach ($rfile as $rfiles):
          ?>
          <div><br><a href="<?=$rfiles['path']?>"><?=$rfiles['name']?></a>&nbsp &nbsp &nbsp<a href="dropfile.php?fid=<?=$rfiles['fid']?>" <?=$style?>>&#10006</a></div><br>
          <?php 
          endforeach;
          ?>
        </div>
      </div>

      <input class='modal__btn btn' type='submit' name='submit' value="Изменить данные" <?=$style?>></input>
    </form>
  </div>
</body>
</html>
<?php 
// }else {
//   header("location:account.php");
// }
}else {
  header("location:login.php");
}
?>