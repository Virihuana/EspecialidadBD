<?php
    include "conexionOracle.php";

    if(isset($_POST['delete'])) {
        $sql = oci_parse($conn,'DELETE FROM platillos WHERE idplat= :IDs');
        $var=$_POST["ID"];
        oci_bind_by_name($sql, ":IDs", $var);

        $r=oci_execute($sql);
        if ($r) {
            print "Registro eliminado";
        }

        oci_commit($conn); // Consigna la transacción pendiente de la base de datos
        oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
        oci_close($conn); // Cierra una conexión a Oracle

    }else{
        echo "ERROR: conexionOracle.php";
    }
?>
