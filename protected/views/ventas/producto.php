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
                              "valor"=>$elProducto->precio_publico,
                              "stock"=>$elProducto->cantidad,
                              "iva"=>$elProducto->iva);
                        $arr = json_encode($ar);
                        echo $arr;
                        
      }
  
?>