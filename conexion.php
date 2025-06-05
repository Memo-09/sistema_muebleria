<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "muebleria_ss";

$conexion = mysqli_connect($servername,$username,$password,$dbname)
OR DIE ("<h3>ERROR AL CONECTAR, VUELVE A INTENTARLO</h3>");
mysqli_query($conexion,"SET NAMES 'utf8'");