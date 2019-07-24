<?php
session_start();
unset($_SESSION["logged"]);
unset($_SESSION["username"]);
header('Location:index.html');
?>