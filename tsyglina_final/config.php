<?php
header('Content-Type: text/html; charset=utf-8');

$host="localhost";
$user="root";
$password="vertrigo";
$db="project";

$connection=mysqli_connect($host, $user, $password, $db);

mysqli_query($connection,"SET NAMES 'utf-8'");