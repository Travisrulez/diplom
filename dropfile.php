<?php
session_start();
include("app/database.php");
if ($_SESSION["u_id"]) {
    $rid = $_SESSION["rid"];
    $fid = $_GET['fid'];
    echo $fid;
    mysqli_query($link, "DELETE FROM files WHERE fid = '".$fid."'");
    header("location: request_edit.php?req_id=$rid");
} else {
    header("location: login.php");
}