<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "sistema_escolar_seduc";


$connect = mysqli_connect($servername,$username,$password,$db_name);
mysqli_set_charset($connect,"utf-8");

mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,'SET character_set_connection=utf8');
mysqli_query($connect,'SET character_set_client=utf8');
mysqli_query($connect,'SET character_set_results=utf8');

if(mysqli_connect_error()):
	echo "Falha na conexão: ".mysqli_connect_error();
endif;

?>