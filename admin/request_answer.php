<!DOCTYPE html>
<html lang="en">
<?php
include("../app/database.php");
include("../app/functions.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
$post = $_GET['post_id'];
if(isset($_POST['submit'])) {
$sql = "update request set answer ='$_POST[answer]' where r_id='$_GET[post_id]'";
            mysqli_query($link, $sql); 
            header("location:requests.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки</title>
    <link rel="stylesheet" href="styles/css/allposts.min.css">
    <link rel="stylesheet" href="styles/css/index.min.css">
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
            <a href="requests.php">Заявки</a>
        </div>
        <a href="requests.php" class="logout">Выход</a>

    </nav>

    <div class="container">
        <div class="wrapper">
            Ответ:<p></p>
            <form method="post" class="form">
                <input type="text" name="answer">
                <input type="submit" name="submit" value="Отправить">
            </form>
        </div>
    </div>
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