<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
             $laFactura = ProductoCompras::model()->find("id=$b");
                        //$ar = array("referencia"=>"Hola", "presentacion"=>"laaaa")
                        $ar = array("saldo"=>$laFactura->saldo);
                        $arr = json_encode($ar);
                        echo $arr;
      }
  
?>