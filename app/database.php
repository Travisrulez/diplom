<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect('std-mysql', 'std_939_diplom', 'tkfynjdj1', 'std_939_diplom');

if (mysqli_connect_errno()) {
    echo 'Ошибка подключения к базе данных ('.mysqli_connect_errno().')'.mysqli_connect_error();
    exit();
}
