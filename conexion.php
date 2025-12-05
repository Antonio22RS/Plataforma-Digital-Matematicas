<?php
#Sirve para crear un archivo PHP

$com="localhost";
$user="root";
$pwd="";
#Crea las variables para conectarse al MySQL
$base="MATEMATICAS";
#Variable con el nombre de la base de datos

$con=new mysqli($com,$user,$pwd,$base) or die("Error de conexion");
#Conecta la base de datos de MySQL o en caso contrario envia el mensaje "Error de conexión"

#Cierra el archivo PHP
?>
