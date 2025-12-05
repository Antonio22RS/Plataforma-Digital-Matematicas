<?php

include('conexion.php');

$n=$_POST['nombre'];
$a=$_POST['apellido'];
$e=$_POST['email'];
$c=$_POST['contra'];
$m=$_POST['matricula'];

$sql="Select * from estudiantes where NAME = '".$n."' and LASTNAME = '".$a."' and USER = '".$e."'";
$datos=$con->query($sql);
$r=$datos->fetch_assoc();

if ($n==$r["NAME"] && $a==$r["LASTNAME"] && $e==$r["USER"]) {

	echo"<script>
	alert('Ya existe un registro con los datos ingresados');
	location.assign('registro.html');</script>";

}else{
	#INSERT INTO estudiantes (ID, Name, Last, User, Pass, Clase, Calificacion) VALUES (1, 'Erika Yael', 'Vega Hernández', '193107151@tesci.edu.mx', 'EYVH1998', 'MATEMATICAS I', '80');
	$sqlin="INSERT INTO estudiantes (NCONTROL, NAME, LASTNAME, USER, PASSWORD) VALUES ('".$m."','".$n."', '".$a."', '".$e."', '".$c."')";
		$resin=$con->query($sqlin);

		$sqlCal="INSERT INTO calificaciones (NCONTROL_ST, MATEMATICAS_I, MATEMATICAS_II, MATEMATICAS_III, MATEMATICAS_IV, MATEMATICAS_V, MATEMATICAS_VI) VALUES ('".$m."','0','0','0','0','0','0')";
		$resCal=$con->query($sqlCal);
		echo"<script>
		alert('El estudiante se ha registrado correctamente.');
		location.assign('sesion_pm.html');</script>";
}

?>