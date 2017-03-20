<?php

include "conexionOracle.php";


if(isset($_POST['get'])){
        $matricula=$_POST["matricula"];
        $arr = array();

        $sql = oci_parse($conn, 'SELECT * FROM NINOS WHERE MATRICULA='.$matricula);
        $r=oci_execute($sql,OCI_DEFAULT);
        $result = oci_fetch_assoc($sql);
        $arr[]=$result;
        echo json_encode($arr, true);        

          oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
          oci_close($conn); // Cierra una conexión a Oracle
}else{
  echo "ERROR EN INSERT RESPONSABLES";
}

?>
