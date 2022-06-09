<?php 
require_once 'includes/session.php';
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
session_destroy();
header("Location: index.php");
exit();
?>