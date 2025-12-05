<?php

include('conexion.php');

$f=$_POST['field'];
$d=$_POST['dato'];
$matricula=$_POST['mat'];

$sql="update estudiantes set ".$f."= '".$d."' where ID = '".$matricula."'";
$datos=$con->query($sql);
$r=$datos->fetch_assoc();

if ($n==$r["Name"] && $a==$r["Last"] && $e==$r["User"]) {

	Header("Location: estudiantes_ind.php");

}else{
	#INSERT INTO estudiantes (ID, Name, Last, User, Pass, Clase, Calificacion) VALUES (1, 'Erika Yael', 'Vega Hernández', '193107151@tesci.edu.mx', 'EYVH1998', 'MATEMATICAS I', '80');
	$sqlin="INSERT INTO estudiantes (Name, Last, User, Pass) VALUES ('".$n."', '".$a."', '".$e."', '".$c."')";
		$resin=$con->query($sqlin);

		$sqlCal="INSERT INTO calificaciones (ID_EST, MATEMATICAS_I, MATEMATICAS_II, MATEMATICAS_III, MATEMATICAS_IV, MATEMATICAS_V, MATEMATICAS_VI) VALUES (LAST_INSERT_ID(),'0','0','0','0','0','0')";
		$resCal=$con->query($sqlCal);
		echo"<script>
		alert('El estudiante se ha registrado correctamente.');
		location.assign('sesion.html');</script>";
}

?>