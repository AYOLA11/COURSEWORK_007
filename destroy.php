<?php
session_start();
unset($_SESSION['user']);
session_destroy();
header("location: story.php?Message=" . "successfully logged out!!");
?>

