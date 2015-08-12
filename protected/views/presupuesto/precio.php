<?php
 
      $buscar = $_POST['b'];
       
      if(!empty($buscar)) {
            buscar($buscar);
      }
       
      function buscar($b) {
            // $con = mysql_connect('localhost','root', 'root');
            // mysql_select_db('base_de_datos', $con);
       
            // $sql = mysql_query("SELECT * FROM anuncios WHERE nombre LIKE '%".$b."%'",$con);
             
            // $contar = mysql_num_rows($sql);
             
             $elprecio = LineaServicio::model()->find("id=$b");
                         
                        echo $elprecio->precio;    
      }
       
?>