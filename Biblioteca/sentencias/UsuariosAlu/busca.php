<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Biblioteca/sentencias/Conexion.php';
$Matricula = $_POST['txtMatricula'];
if ($Matricula > 0) {
    $Query1 = "SELECT nombre,apaterno,amaterno, correo, telefono, id_carrera from persona,alumnos where persona.id_alumno=" . $Matricula . " and alumnos.id_alumno=" . $Matricula . ";";
    $Resultados = mysql_query($Query1);
    $Nombre = "w";
    $APaterno="";
    $AMaterno="";
    $COrreo_Electronico="";
    $Telefono="";
    $Carrera="";
    try {
        while ($row = mysql_fetch_array($Resultados)) {
            $Nombre = $row['0'];
            $APaterno = $row['1'];
            $AMaterno = $row['2'];
            $Correo_Electronico = $row['3'];
            $Telefono = $row['4'];
            $Query2 = "Select cve_carrera from carreras where num_carrera=" . $row['5'] . ";";
            $Resultados2 = mysql_query($Query2);
            while ($row2 = mysql_fetch_array($Resultados2)) {
                $Carrera = $row2['0'];
            }
        }
        if (trim($Nombre) == NULL) {
            echo 'Este usuario no existe. Quizas pusiste un numero decimal';
        } else {         
            echo ''.$Nombre.' '.$APaterno.' '.$AMaterno. ' '.$Telefono. ' '. $COrreo_Electronico. ' '.$Carrera;
            }
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
} else {
    echo 'Por favor escriba una matricula mayor a cero.';
    echo '<a href="http://localhost/Biblioteca/vntPrincipal.php"><input type="submit" value="Aceptar"></a>';
}
mysql_close($link);?>