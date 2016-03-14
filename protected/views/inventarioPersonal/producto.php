<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
      $elProducto = ProductoInventarioDetalle::model()->find("id=$b");
            //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
            $ar = array("referencia"=>$elProducto->productoInventario->producto_referencia,
                  "presentacion"=>$elProducto->productoInventario->productoPresentacion->presentacion,
                  "lote"=>$elProducto->lote,
                  "unidad"=>$elProducto->productoInventario->productoUnidadMedida->corto,
                  "stock"=>$elProducto->existencia,
                  "idProducto"=>$elProducto->producto_inventario_id);
            $arr = json_encode($ar);
            echo $arr;

      // $elProducto = ProductoInventario::model()->find("id=$b");
      //       //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
      //       $ar = array("referencia"=>$elProducto->producto_referencia,
      //             "presentacion"=>$elProducto->productoPresentacion->presentacion,
      //             "lote"=>$elProducto->lote,
      //             "unidad"=>$elProducto->productoUnidadMedida->corto,
      //             "stock"=>$elProducto->cantidad);
      //       $arr = json_encode($ar);
      //       echo $arr;
      }
  
?>