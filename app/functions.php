<?php 

function get_requests() {
    global $link;
    $sql = "SELECT * FROM request ORDER BY r_id DESC";
    $result = mysqli_query($link, $sql);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $requests;

}
