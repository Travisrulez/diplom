<?php 

function get_requests() {
    global $link;
    $sql = "SELECT * FROM request ORDER BY r_id DESC";
    $result = mysqli_query($link, $sql);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $requests;

}

function get_request($r_id) {
    global $link;
    $sql = "SELECT * FROM request WHERE r_id=". $r_id;
    $result = mysqli_query($link, $sql);
    $request = mysqli_fetch_assoc($result);
    return $request;
}

function get_a_requests() {
    global $link;
    $sql = "SELECT * FROM request WHERE answer IS NULL ORDER BY r_id DESC";
    $result = mysqli_query($link, $sql);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $requests;

}

function get_c_requests() {
    global $link;
    $sql = "SELECT * FROM request WHERE answer > ' ' ORDER BY r_id DESC";
    $result = mysqli_query($link, $sql);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $requests;

}

function get_request_u($u_id) {
    global $link;
    $sql = "SELECT * FROM request WHERE u_id=". $u_id;
    $result = mysqli_query($link, $sql);
    $urequest = mysqli_fetch_assoc($result);
    return $urequest;
}

function get_posts() {
    global $link;
    $sql = "SELECT * FROM post ORDER BY p_id DESC";
    $result = mysqli_query($link, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;

}

function get_posts_p($p_id) {
    global $link;
    $sql = "SELECT * FROM post WHERE p_id=". $p_id;
    $result = mysqli_query($link, $sql);
    $pposts = mysqli_fetch_assoc($result);
    return $pposts;
}

function get_files() {
    global $link;
    $ssql = "SELECT * FROM files ORDER BY fid DESC";
    $result = mysqli_query($link, $ssql);
    $f = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $f;

}

function get_files_by_user($u_id) {
    global $link;
    $ssql = "SELECT * FROM files WHERE uid=". $u_id;
    $result = mysqli_query($link, $ssql);
    $ufiles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $ufiles;

}
