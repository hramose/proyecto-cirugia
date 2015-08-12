<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
             $elProducto = InventarioPersonalDetalle::model()->find("producto_id=$b and inventario_personal_id = ".Yii::app()->user->usuarioId);
                        //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
                        $ar = array("referencia"=>$elProducto->producto->producto_referencia,
                              "medida"=>$elProducto->producto->productoUnidadMedida->medida,
                              "stock"=>$elProducto->cantidad);
                        $arr = json_encode($ar);
                        echo $arr;
                        
      }

      // function buscar($b) {
      //        $elProducto = ProductoInventario::model()->find("id=$b");
      //                   //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
      //                   $ar = array("referencia"=>$elProducto->producto_referencia,
      //                         "medida"=>$elProducto->productoUnidadMedida->medida,
      //                         "stock"=>$elProducto->cantidad);
      //                   $arr = json_encode($ar);
      //                   echo $arr;
                        
      // }
  
?>