<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect('localhost', 'root', 'root', 'diplom');

if (mysqli_connect_errno()) {
    echo 'Ошибка подключения к базе данных ('.mysqli_connect_errno().')'.mysqli_connect_error();
    exit();
}