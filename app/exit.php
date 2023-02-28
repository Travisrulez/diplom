<?php 
// ini_set('session.gc_max_lifetime', 0);
// ini_set('session.gc_probability', 1);
// ini_set('session.gc_divisor', 1);
session_start();
session_destroy();
// $_SESSION["u_id"] = " ";
header("location:../index.php");