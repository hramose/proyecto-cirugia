<?php
//include 'conexionbd.php';
//if ($mysqli -> multi_query("CALL sp_GetPoblaciones(" . $_GET['pr'] . ")")) {
$elProveedor = $_GET['pr'];
if ($mysqli = ProductoCompras::model()->findAll("producto_proveedor_id = $elProveedor")) {
    $facturas = array();
    foreach ($mysqli as $my_sqli) {
    	$facturas[$my_sqli->id] = [$my_sqli->factura_n];
    }
    /*do {
        if ($result = $mysqli -> store_result()) {
            while ($fila = $result -> fetch_assoc()) {               
                $facturas[$fila['id']] = $fila['factura_n'];
            }
        }
    } while($mysqli->next_result());*/
    print_r(json_encode($facturas));
}
?>