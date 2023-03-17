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
$r_id = $_GET['r_id'];
if (isset($_POST['submit'])) {
    $sqll = "update request set answer ='$_POST[answer]' where r_id='$r_id'";
            mysqli_query($link, $sqll); 
            header("location:request_page.php?r_id=" .$r_id);
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
    <header class="header">
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
    </header>

    <nav class="navbar">
        <div class="navbar__item">
            <!-- <div class="icon"><img src="img/icons/home.png" alt="homepage-icon"></div> -->
            <a href="active_requests.php">Активные заявки</a>
        </div>
        <div class="navbar__item">
            <!-- <div class="icon"><img src="img/icons/home.png" alt="homepage-icon"></div> -->
            <a href="close_requests.php">Закрытые заявки</a>
        </div>
        <div class="navbar__item">
            <!-- <div class="icon"><img src="img/icons/home.png" alt="homepage-icon"></div> -->
            <a href="afisha.php">Конференции</a>
            <a href="afisha_add.php" style="font-size:30px">+</a>
        </div>
        <a href="index.php" class="logout">Выход</a>

    </nav>

    <div class="container">
        <div class="wrapper">
            <?php 
            $request = get_request($r_id);
            $u_id = $request['u_id'];
            ?>
            <form class="form" action='' method='post' enctype="multipart/form-data">
                <div class="form__item short-form">
                    <label for="title">Имя</label>
                    <input type="text" name="p_title" id="title" value="<?=$request['name']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Статус участника</label>
                    <input type="text" name="p_start" id="start" value="<?=$request['status']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Дата рождения</label>
                    <input type="text" name="idn" id="start" value="<?=$request['birthday']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Номер телефона</label>
                    <input type="text" name="idn" id="start" value="<?=$request['phone']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Почта</label>
                    <input type="text" name="idn" id="start" value="<?=$request['email']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Название статьи</label>
                    <input type="text" name="idn" id="start" value="<?=$request['title']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Количество страниц</label>
                    <input type="text" name="idn" id="start" value="<?=$request['pages']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Научный руководитель</label>
                    <input type="text" name="idn" id="start" value="<?=$request['director']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Место работы</label>
                    <input type="text" name="idn" id="start" value="<?=$request['place']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Дата подачи</label>
                    <input type="text" name="idn" id="start" value="<?=$request['date']?>" readonly style="background-color: lightgray;">
                </div>
                <div class="form__item short-form">
                    <label for="start">Файлы:</label>
                    <?php 
                    $r_id = $request['r_id'];
                    $files = get_files_by_request($r_id);
                    foreach ($files as $file):
                    ?>
                    <a href="../<?=$file['path']?>"><?=$file['name']?></a><br>
                    <?php 
                    endforeach;
                    ?>
                </div>
                <div>
                <?php 
                $canswer = $request['answer'];
                if ($canswer == 0) 
                    {
                        $answer = "Еще никто не оставил рецензию";
                    } else {
                        $answer = $request['answer'];
                    }
                ?>
                <div class="form__item short-form">
                    <label for="start">Рецензия</label>
                    <input type="text" name="answer" id="start" style="width: 250px!important; padding: 5px 0 5px 10px!important" value="<?=$answer?>">
                </div>
                <div class="form__item submit">
                    <input type="submit" name="submit" id="submit" value="Отправить ответ"></input>
                </div>
                </div>
            </form>
            <?php
            echo $_SESSION['error'];
            echo $_SESSION['success'];
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