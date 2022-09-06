<?php
session_start();
session_destroy();
header("location:f_login.php");

?>