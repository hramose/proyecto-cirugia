<?php
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
             $elContrato = Contratos::model()->find("id=$b");
                        
                        $elTotal = array("total"=>$elContrato->total,
                              "saldo"=>$elContrato->saldo);
                        $el_total = json_encode($elTotal);
                        echo $el_total;
                        
      }
  
?>