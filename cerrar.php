<?php

session_destroy();
#Termina la sesión

Header("Location:sesion_pm.html");
#Redirecciona a la pagina de inicio al finalizar la sesión

?>