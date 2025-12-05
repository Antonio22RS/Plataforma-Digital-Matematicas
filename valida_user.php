<?php

include('conexion.php');

$u=$_POST['user'];
$p=$_POST['pass'];
$ue=$_POST['user'];
$pe=$_POST['pass'];

$sql="Select * from docentes where USER='".$u."' and PASSWORD='".$p."'";

$datos=$con->query($sql);
$r=$datos->fetch_assoc();

if($r["USER"]!=$u || $r["PASSWORD"]!=$p){ 

echo "<script>
alert('El usuario o contraseña es incorrecto.');
location.assign('sesion_pm.html');
</script>";

}

session_start();

$sen="Select count(ID) as total from docentes where USER='".$u."' and PASSWORD='".$p."'";

$res=$con->query($sen);
$d=$res->fetch_assoc();

if($d["total"]==1){ 

  $resn=$con->query($sen);
  $d=$res->fetch_assoc();

  $_SESSION['Username']=$r["NAME"];
  Header("Location: inicio_doc.php");

}


$sqle="Select * from estudiantes where USER='".$ue."' and PASSWORD='".$pe."'";

$datose=$con->query($sqle);
$re=$datose->fetch_assoc();

if($re["USER"]!=$ue || $re["PASSWORD"]!=$pe){ 

echo "<script>
alert('El usuario o contraseña es incorrecto.');
location.assign('sesion_pm.html');
</script>";

}

session_start();

$sene="Select count(NCONTROL) as total_e from estudiantes where USER='".$ue."' and PASSWORD='".$pe."'";

$rese=$con->query($sene);
$de=$rese->fetch_assoc();

if($de["total_e"]==1){ 

  $_SESSION['Username']=$re["NAME"];
  $_SESSION['matricula']=$re["NCONTROL"];
  Header("Location: inicio_est.php");

}

?>
