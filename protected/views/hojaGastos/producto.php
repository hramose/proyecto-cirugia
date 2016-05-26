<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      } 
      // function buscar($b) {
      //        $elProducto = ProductoInventario::model()->find("id=$b");
      //                   //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
      //                   $ar = array("referencia"=>$elProducto->producto_referencia,
      //                         "presentacion"=>$elProducto->productoPresentacion->presentacion,
      //                         "lote"=>$elProducto->lote,
      //                         "unidad"=>$elProducto->productoUnidadMedida->corto,
      //                         "stock"=>$elProducto->cantidad);
      //                   $arr = json_encode($ar);
      //                   echo $arr;                
      // }

      function buscar($b) {
             $elProducto = InventarioPersonalDetalle::model()->find("id=$b and inventario_personal_id = ".Yii::app()->user->usuarioId);
                        //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
                        $ar = array("referencia"=>$elProducto->producto->producto_referencia,
                              "presentacion"=>$elProducto->producto->productoPresentacion->presentacion,
                              "lote"=>$elProducto->lote,
                              "unidad"=>$elProducto->producto->productoUnidadMedida->corto,
                              "stock"=>$elProducto->cantidad,
                              "elid"=>$elProducto->producto_id);
                        $arr = json_encode($ar);
                        echo $arr;
                        
      }
  
?>