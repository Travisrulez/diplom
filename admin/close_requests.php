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
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки</title>
    <link rel="stylesheet" href="styles/css/allposts.min.css">
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
            <div class="posts">
                <?php $requests = get_c_requests();?>
                <?php foreach ($requests as $request):?>
                <div class="posts__item">
                    <div class="content">
                    <a href="request_page.php?r_id=<?=$request['r_id'];?>"><?=$request['name']?></a>
                        <?=$request['email']?>
                        <br>
                        <br>
                        <?=$request['phone']?>
                        <div>Скачать: <br>
                        <?php
                            $u_id = $request['u_id'];
                            $r_id = $request['r_id'];
                            $ufiles = get_files_by_request($r_id);
                            foreach ($ufiles as $ufile):
                        ?>    
                        <a href="../<?=$ufile['path']?>"><?=$ufile['name']?></a><br>
                        <?php
                            endforeach;
                            ?>
                    </div>
                        <?=$request['date']?>
                    </div>
                    <div class="options">
                        <img src="img/icons/options.png" alt="options">
                        <div class="click-handler">
                            <div class="options-list">
                                <div class="option edit">
                                    <div class="icon"><img src="img/icons/edit.png" alt="icon"></div>
                                    <a href="request_answer.php?post_id=<?=$request['r_id'];?>">Оставить рецензию</a>
                                </div>
                                <!-- <div class="option delete">
                                    <div class="icon"><img src="img/icons/delete.png" alt="icon"></div>
                                    <a href="request_del.php?del_post=<?=$request['r_id'];?>">Удалить</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
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