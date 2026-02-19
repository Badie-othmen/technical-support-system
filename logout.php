<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
