<?php
//all the variables defined here are accessible in all the files that include this one
$con= new mysqli('localhost','root','','project')or die("Could not connect to mysql".mysqli_error($con));
mysqli_set_charset($con,"utf-8");
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,'SET character_set_connection=utf8');
mysqli_query($con,'SET character_set_client=utf8');
mysqli_query($con,'SET character_set_results=utf8');
?>