<!DOCTYPE html>
<html lang="en">
<?php
include("../app/database.php");
include("../app/functions.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
session_start();
$p_id = $_GET['post_id'];
if(isset($_POST['submit'])) {
    $fname = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fsize = $_FILES['file']['size'];
    $extension = explode('.',$fname);
    $extension = strtolower(end($extension));  
    $fnew = uniqid().'.'.$extension;
    $store = "img/org/".basename($fnew);                  
    if($extension == 'jpg'||$extension == 'png'||$extension == 'gif') {        
        if ($fsize>=1000000) {
            $error = 	'<div class="modal error">
                            Максимальный размер изображения 1 Mb!
                        </div>';
        } else {
            $sqll = "update post set p_title ='$_POST[p_title]', p_start ='$_POST[p_start]', idn ='$_POST[idn]', p_scontent ='$_POST[p_scontent]', p_scontent1 ='$_POST[p_scontent1]', 
            p_scontent2 ='$_POST[p_scontent2]', p_scontent3 ='$_POST[p_scontent3]', p_scontent4 ='$_POST[p_scontent4]', p_scontent5 ='$_POST[p_scontent5]',
            p_scontent6 ='$_POST[p_scontent6]', p_scontent7 ='$_POST[p_scontent7]', p_scontent8 ='$_POST[p_scontent8]',
            p_scontent9 ='$_POST[p_scontent9]', p_scontent10 ='$_POST[p_scontent10]', p_scontent11 ='$_POST[p_scontent11]',
            p_scontent12 ='$_POST[p_scontent12]', p_content ='$_POST[p_content]', date1 ='$_POST[date1]',
            name1 ='$_POST[name1]', content1 ='$_POST[content1]', date2 ='$_POST[date2]',
            name2 ='$_POST[name2]', content2 ='$_POST[content2]', date3 ='$_POST[date3]',
            name3 ='$_POST[name3]', content3 ='$_POST[content3]', fio1 ='$_POST[fio1]',
            status1 ='$_POST[status1]', file='$fnew' where p_id='$p_id'";
            mysqli_query($link, $sqll); 
            move_uploaded_file($temp, $store);

            $success = 	'<div class="modal success">
                            Запись успешно изменена!
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
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки</title>
    <link rel="stylesheet" href="styles/css/allposts.min.css">
    <link rel="stylesheet" href="styles/css/post_add.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="scripts/script.js" defer></script>
</head>
<body>
    <!-- <header class="header">
        <div class="header__logo">
            <h1>Менеджер</h1>
        </div>
        <div class="menu">
            <div class="line"></div>
        </div>
        <div class="page-title">Заявки</div>
        <div class="header__authorization">
            <a href="index.php" class="logout">Выход</a>
        </div>
    </header> -->

    <!-- <nav class="navbar">
        <div class="navbar__item">
            <a href="requests.php">Заявки</a>
        </div>
        <div class="navbar__item">
            <a href="afisha.php">Конференции</a>
            <a href="afisha_add.php" style="font-size:30px">+</a>
        </div>
        <a href="index.php" class="logout">Выход</a>
    </nav> -->

    <div class="container">
    <?php $posts = get_posts_p($p_id);?>
        <div class="wrapper">
            <form class="form" method='post' enctype="multipart/form-data">
                <div class="form__item short-form">
                    <label for="title">Заголовок</label>
                    <input type="text" name="p_title" id="title" value="<?=$posts['p_title']?>">
                </div>
                <div class="form__item short-form">
                    <label for="start">Начало</label>
                    <input type="text" name="p_start" id="start" value="<?=$posts['p_start']?>">
                </div>
                <div class="form__item short-form">
                    <label for="start">Идентификатор</label>
                    <input type="text" name="idn" id="start" value="<?=$posts['idn']?>">
                </div>
                <div class="form__item">
                    <label for="short-content">Описание <small style="color: #777;">(Максимум 200 символов)</small></label>
                    <input type="text" name="p_scontent" id="short-content" maxlength="200" value="<?=$posts['p_scontent']?>">
                </div>
                <div class="form__item">
                    <label for="short-content">Проблематика <small style="color: #777;">(Максимум 200 символов)</small></label>
                    <input type="text" name="p_scontent1" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent1']?>">
                    <input type="text" name="p_scontent2" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent2']?>">
                    <input type="text" name="p_scontent3" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent3']?>">
                    <input type="text" name="p_scontent4" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent4']?>">
                    <input type="text" name="p_scontent5" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent5']?>">
                    <input type="text" name="p_scontent6" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent6']?>">
                    <input type="text" name="p_scontent7" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent7']?>">
                    <input type="text" name="p_scontent8" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent8']?>">
                    <input type="text" name="p_scontent9" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent9']?>">
                    <input type="text" name="p_scontent10" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent10']?>">
                    <input type="text" name="p_scontent11" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent11']?>">
                    <input type="text" name="p_scontent12" id="short-content" maxlength="200" style="margin-top: 5px; width: 30%;" value="<?=$posts['p_scontent12']?>">
                </div>
                <div class="form__item">
                    <label for="content">Условия участия</label>
                    <textarea id="mytextarea" name="p_content" class="form-control form-control-danger"><?=$posts['p_content']?></textarea>
                </div>
                <h3>Этапы:</h3>
                <div class="form__item">
                    <h3>Первый этап:</h3>
                    <label for="short-content">Даты</label>
                    <input type="text" name="date1" id="short-content" maxlength="200" value="<?=$posts['date1']?>">
                    <label for="short-content">Навзание</label>
                    <input type="text" name="name1" id="short-content" maxlength="200" value="<?=$posts['name1']?>">
                    <label for="short-content">Описание</label>
                    <input type="text" name="content1" id="short-content" maxlength="200" value="<?=$posts['content1']?>">
                </div>
                <div class="form__item">
                    <h3>Второй этап:</h3>
                    <label for="short-content">Даты</label>
                    <input type="text" name="date2" id="short-content" maxlength="200" value="<?=$posts['date2']?>">
                    <label for="short-content">Навзание</label>
                    <input type="text" name="name2" id="short-content" maxlength="200" value="<?=$posts['name2']?>">
                    <label for="short-content">Описание</label>
                    <input type="text" name="content2" id="short-content" maxlength="200" value="<?=$posts['content2']?>">
                </div>
                <div class="form__item">
                    <h3>Третий этап:</h3>
                    <label for="short-content">Даты</label>
                    <input type="text" name="date3" id="short-content" maxlength="200" value="<?=$posts['date3']?>">
                    <label for="short-content">Навзание</label>
                    <input type="text" name="name3" id="short-content" maxlength="200" value="<?=$posts['name3']?>">
                    <label for="short-content">Описание</label>
                    <input type="text" name="content3" id="short-content" maxlength="200" value="<?=$posts['content3']?>">
                </div>
                <h3>Организаторы:</h3>
                <div class="form__item">
                    <h3>Первый организатор:</h3>
                    <label for="short-content">ФИО</label>
                    <input type="text" name="fio1" id="short-content" maxlength="200" value="<?=$posts['fio1']?>">
                    <label for="short-content">Статус</label>
                    <input type="text" name="status1" id="short-content" maxlength="200" value="<?=$posts['status1']?>">
                    <label for="background">Фото</label>
                    <input type="file" name="file" id="background"></input>
                </div>
                <div class="form__item">
                    <h3>Первый организатор:</h3>
                    <label for="short-content">ФИО</label>
                    <input type="text" name="fio2" id="short-content" maxlength="200">
                    <label for="short-content">Статус</label>
                    <input type="text" name="status2" id="short-content" maxlength="200">
                    <label for="background">Фото</label>
                    <input type="file" name="file1" id="background"></input>
                </div>
                <div class="form__item">
                    <h3>Второй организатор:</h3>
                    <label for="short-content">ФИО</label>
                    <input type="text" name="fio2" id="short-content" maxlength="200">
                    <label for="short-content">Статус</label>
                    <input type="text" name="status2" id="short-content" maxlength="200">
                    <label for="background">Фото</label>
                    <input type="file" name="file1" id="background"></input>
                </div>
                <div class="form__item">
                    <h3>Третий организатор:</h3>
                    <label for="short-content">ФИО</label>
                    <input type="text" name="fio3" id="short-content" maxlength="200">
                    <label for="short-content">Статус</label>
                    <input type="text" name="status3" id="short-content" maxlength="200">
                    <label for="background">Фото</label>
                    <input type="file" name="file1" id="background"></input>
                </div>
                <div class="form__item submit">
                    <input type="submit" name="submit" value="Сохранить"></input>
                </div>
            </form>
            <?php
            // echo $_SESSION['error'];
            // echo $_SESSION['success'];
            ?>
        </div>  
    </div>
    <script src="https://cdn.tiny.cloud/1/cvj5zmyfd449sew2ai4nu7zewycidaain44nb5fnqbcf81pv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script>
    <script>
        const optionBtns = document.querySelectorAll('.options img');
        optionBtns.forEach(item => {
            item.addEventListener('click', openCloseOptions);
        });

        function openCloseOptions(e) {
            if (!e.target.parentElement.classList.contains('active')) {
                document.querySelectorAll('.options').forEach(item => {
                    item.classList.remove('active');
                });
                e.target.parentElement.classList.add('active');
                document.body.addEventListener('click', closeAll);
            } else {
                e.target.parentElement.classList.remove('active');
            }
        }

        function closeAll(e) {
            if (!e.target.closest('.options')) {
                document.querySelectorAll('.options').forEach(item => {
                    item.classList.remove('active');
                });
                document.body.removeEventListener('click', closeAll);
            }
        }
    </script>
</body>
</html>