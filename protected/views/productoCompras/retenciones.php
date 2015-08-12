<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
             $laRetencion = ProductoRetenciones::model()->find("id=$b");
                        
                        $ar = array("a_retener"=>$laRetencion->a_retener,
                              "base"=>$laRetencion->base,
                              "porcentaje"=>$laRetencion->porcentaje);
                        $arr = json_encode($ar);
                        echo $arr;
                        
      }
  
?>