<?php session_start();
unset($_SESSION['category']);
unset($_SESSION['theme']);
unset($_SESSION['title']);
unset($_SESSION['content']);
header('Location: ../index.php?EX=writeMessages');?>