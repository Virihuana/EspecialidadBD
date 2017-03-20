<?php

include "conexionOracle.php";


if(isset($_POST['get'])){
        $idTut=$_POST["idtut"];
        //$arr = array();

        $sql = oci_parse($conn, 'SELECT * FROM TELEFONOS WHERE TUTORID='.$idTut);
        $r=oci_execute($sql,OCI_DEFAULT);
            
        $tabla="<h5>Telefonos</h5><table class='table table-striped table-bordered table-hover'><thead><tr>".
        "<th>Telefono</th>".
        "<th>tipo</th>".
        "<th></th>".
        "<th></th>".
        "</tr></thead>";
      
        while (($row = oci_fetch_assoc($sql)) != false) {
          //echo $row["MATRICULA"];
          $tabla .="<tbody><tr><td>"
                  .$row["TELEFONO"] ."</td><td>"
                  .$row["TIPO"] ."</td><td>"                  
                  ."<button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='eliminarTel(".$row['TELEFONO'].");'>Eliminar</button></td><td>"                  
                  ."</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;




      /*  $result = oci_fetch_assoc($sql);
        $arr[]=$result;
        echo json_encode($arr, true);        
*/
          oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
          oci_close($conn); // Cierra una conexión a Oracle
}else{
  echo "ERROR EN INSERT RESPONSABLES";
}

?>
