<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
             $elProducto = ProductoInventario::model()->find("id=$b");
                        //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
                        $ar = array("referencia"=>$elProducto->producto_referencia,
                              "presentacion"=>$elProducto->productoPresentacion->presentacion,
                              "lote"=>$elProducto->lote,
                              "unidad"=>$elProducto->productoUnidadMedida->corto,
                              "stock"=>$elProducto->cantidad);
                        $arr = json_encode($ar);
                        echo $arr;
                        
      }
  
?>