<?php

include "conexionOracle.php";

if (!$conn) {    
    $m = oci_error();    
    echo $m['message'], "n";    
    exit; 
} else {    
    $sql = oci_parse($conn, 'SELECT * FROM NINOS');
    oci_execute($sql,OCI_DEFAULT);
    //oci_fetch_all($sql, $res);
    //$nrows = oci_fetch_all($sql, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
    //echo "$nrows";
    //if($nrows > 0){
        $tabla="<h5>NIÑOS</h5><table class='table table-striped table-bordered table-hover'><thead><tr>".
        "<th>Matricula</th>".
        "<th>Nombres</th>".
        "<th>Apellido Paterno</th>". 
        "<th>Apellido Materno</th>".
        "<th>Fecha Nacimiento</th>".
        "<th>Fecha Ingreso</th>".
        "<th>Fecha Egreso</th>".
        "<th>Colegiatura</th>".
        "<th></th>".
        "</tr></thead>";
      
        while (($row = oci_fetch_assoc($sql)) != false) {
          //echo $row["MATRICULA"];
          $tabla .="<tbody><tr><td>"
                  .$row["MATRICULA"] ."</td><td>"
                  .$row["NOMBRES"] ."</td><td>"
                  .$row["APATERNO"] ."</td><td>"
                  .$row["AMATERNO"] ."</td><td>"
                  .$row["FNACIMIENTO"] ."</td><td>"
                  .$row["FINGRESO"] ."</td><td>"
                  .$row["FEGRESO"] ."</td><td>"
                  .$row["COLEGIATURA"] ."</td><td>"
                  ."<button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='eliminarNino(".$row['MATRICULA'].");'>Eliminar</button></td>"
                  ."</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;
    /*} else {
        echo "0 results EMPLEADOS";
    }     */
    /*echo "<pre>\n";
    var_dump($res);
    echo "</pre>\n";*/
} 
 
// Close the Oracle connection 
oci_close($conn); 

?>
