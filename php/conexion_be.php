<?php
$conexion=mysqli_connect("localhost","root","","clinica",3306);

if($conexion){
    echo "Conexion con la base de datos exitosa";
}else{
    echo "Conexion con la base de datos interrumpida";
}

?>