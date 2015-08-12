<?php
/* @var $this PresupuestoController */
/* @var $model Presupuesto */
/* @var $form CActiveForm */
?>

<?php

$elPaciente = $model->paciente_id;

//Es Liquidación
$liquidar = 0;
$totalContrato = 0;
if (isset($_GET['liquidar'])) 
{
	$liquidar = 1;
	//$registros = ContratoDetalle::model()->findAll("contrato_id = $model->id and realizadas > 0");
	$registros = ContratoDetalle::model()->findAll("contrato_id = $model->id");
	//$totalContrato = 0;
	foreach ($registros as $los_registros) 
	{
		$totalContrato = $totalContrato + $los_registros->total;
	}
}
else
{
	$liquidar = 0;
	$registros = ContratoDetalle::model()->findAll("contrato_id = $model->id");
	$totalContrato = $model->total;
}

$paciente = Paciente::model()->find("id=$elPaciente");
$lineasdeservicio = LineaServicio::model()->findAll(array("condition" => "estado = 'activo'", 'order'=>'nombre asc'));

?>

<div class="row">
	<div class="span5">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$paciente,
		'attributes'=>array(
			'nombreCompleto',
		),
	)); ?>
	<a class="btn btn-warning" href='index.php?r=paciente/view&id=<?php echo $paciente->id;?>'><i class="icon-search icon-white"></i> Ficha de Paciente</a>
	</div>

	<div class='span5'>
		<h2>Total:</h2>
		<input type='text' id='total' name='total' class="input-medium" readonly='readonly' value=<?php echo $totalContrato; ?>>
	</div>
</div>

<div class="row">
	<div class="span10"></div>
</div>

<div class="row">
	<div class="span11">
		<?php if ($liquidar == 0){ ?>
		<form id="Contrato" name="Contrato" action="index.php?r=contratos/actualizarContrato&idPaciente=<?php echo $elPaciente;?>&id=<?php echo $model->id; ?>" method = "post" onsubmit="onEnviar()">
		  <?php }else{ ?>
		<form id="contrato_liquidar" name="contrato_liquidar" action="index.php?r=contratos/actualizarContratoLiquidar&idPaciente=<?php echo $elPaciente;?>&id=<?php echo $model->id; ?>" method = "post" onsubmit="onEnviar()">
		  <?php } ?>
			<?php if ($liquidar == 0): ?>
				<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Linea de Servicio </a>	
			<?php endif ?>
		    
			<hr>
			<table class "table">
				<tr>
					<th width="23%">Linea de Servicio</th>
					<th width="8%">Cantidad</th>
					<th width="12%">Valor Unitario</th>
					<th width="8%">Descuento</th>
					<th width="11%">V.U. con Descuento</th>
					<th width="11%">V.T. sin Descuento</th>
					<th width="11%">V.T. con Descuento</th>
					<th width="10%">Total</th>
					<th width="10%"></th>
				</tr>
			</table>

		   <div id="contenedorcampos">
		   <?php 
		   $campos = 1;
			foreach($registros as $losregistros){ ?>
			<div id="divcampo_<?php echo $campos; ?>">
		   <table class='table'>
		   <tr>
		     <td nowrap='nowrap'>
		     	<?php if ($liquidar == 0): ?>
				 <select name='linea_<?php echo $campos; ?>' id='linea_<?php echo $campos; ?>'>
					
					<?php foreach($lineasdeservicio as $linea_servicio){ 
						if ($linea_servicio->id == $losregistros->linea_servicio_id) {
						?>
						<option selected value='<?php echo $linea_servicio->id; ?>'><?php echo $linea_servicio->nombre; ?></option>
						<?php
						}
						else
						{
						?>
						<option value='<?php echo $linea_servicio->id; ?>'><?php echo $linea_servicio->nombre; ?></option>
						<?php
						}
						?>

					
					<?php } ?>
				 </select>
				 <?php endif ?>
				 <?php if ($liquidar == 1): ?>
				 <select name='linea_<?php echo $campos; ?>' readonly='readonly' id='linea_<?php echo $campos; ?>'>
					
					<?php foreach($lineasdeservicio as $linea_servicio){ 
						if ($linea_servicio->id == $losregistros->linea_servicio_id) {
						?>
						<option selected value='<?php echo $linea_servicio->id; ?>'><?php echo $linea_servicio->nombre; ?></option>
						<?php
						}
						else
						{
						?>
						<option value='<?php echo $linea_servicio->id; ?>'><?php echo $linea_servicio->nombre; ?></option>
						<?php
						}
						?>

					
					<?php } ?>
				 </select>
				 <?php endif ?>
		     </td>
		     <td nowrap='nowrap'>
		     	<?php if ($liquidar == 0): ?>
		        	<input type='text' class='input-mini' maxlength = 2 placeholder='Cantidad' name='cantidad_<?php echo $campos; ?>' id='cantidad_<?php echo $campos; ?>' value ='<?php echo $losregistros->cantidad ?>'>
		        <?php endif ?>

		        <?php if ($liquidar == 1): ?>
		        	<input type='text' class='input-mini' maxlength = 2 placeholder='Cantidad' name='cantidad_<?php echo $campos; ?>' id='cantidad_<?php echo $campos; ?>' readonly='readonly' value ='<?php echo $losregistros->cantidad ?>'>
		        <?php endif ?>
		     </td>
		     <td nowrap='nowrap'>
		        <input type='text' class='input-small' placeholder='V. Unitario' name='vu_<?php echo $campos; ?>' id='vu_<?php echo $campos; ?>' readonly='readonly' value ='<?php echo $losregistros->vu ?>'>
		     </td>
		     <td nowrap='nowrap'>
		        <input type='text' class='input-mini' maxlength = 3 autocomplete='off' placeholder='Descuento' name='desc_<?php echo $campos; ?>' id='desc_<?php echo $campos; ?>' value ='<?php echo $losregistros->desc ?>'>
		     </td>
		     <td nowrap='nowrap'>
		        <input type='text' class='input-small' autocomplete='off' placeholder='V.U Descuento' name='vu_desc_<?php echo $campos; ?>' id='vu_desc_<?php echo $campos; ?>' value ='<?php echo $losregistros->vu_desc ?>'>
		     </td>
		     <td nowrap='nowrap'>
		        <input type='text' class='input-small' placeholder='Total sin Descuento' name='vt_sin_desc_<?php echo $campos; ?>' id='vt_sin_desc_<?php echo $campos; ?>' readonly='readonly' value ='<?php echo $losregistros->vt_sin_desc ?>'>
		     </td>
		     <td nowrap='nowrap'>
		        <input type='text' class='input-small' placeholder='Total con Descuento' name='vt_con_desc_<?php echo $campos; ?>' id='vt_con_desc_<?php echo $campos; ?>' readonly='readonly' value ='<?php echo $losregistros->vt_con_desc ?>'>
		     </td>
		     <td nowrap='nowrap'>
		        <input type='text' class='input-small' placeholder='Total' name='total_<?php echo $campos; ?>' id='total_<?php echo $campos; ?>' readonly='readonly' value ='<?php echo $losregistros->total ?>'>
		     </td>
		     <td nowrap='nowrap'>
		     	<?php if (!isset($_GET['liquidar'])): ?>
		     		<a href='JavaScript:quitarCampo(<?php echo $campos; ?>);' class='btn btn-mini btn-danger'> [x] </a>	
		     	<?php endif ?>
		     </td>
		   </tr>
		</table>
		</div>
	<?php 
		$campos++;
		} 
	?>


		   </div>
		  	
		  <div>
		  	<label>Vendedor:</label>
		<select name='vendedor_id' id='vendedor_id'>
				<?php 
				$losVendedores = Personal::model()->findAll("activo = 'SI' and id > 0 order by 'nombres'");
				foreach($losVendedores as $los_vendedores){ ?>
				<option value='<?php echo $los_vendedores->id; ?>'><?php echo $los_vendedores->nombreCompleto; ?></option>
				<?php } ?>
			</select>
		
			  		<label>Observaciones:</label>
				  	<textarea rows="6" class = "input-xxlarge" name ="observaciones" id="observaciones"><?php echo $model->observaciones; ?></textarea>
			  	<br>
			  	<br>
			  				  	
		  	<input id='variable' name='variable' type='hidden' />
		  	
		  </div>
		   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
		   <a href="index.php?r=contratos/view&id=<?php echo $model->id; ?>" class="btn btn-inverse">Cancelar</a>
		   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

		   
		</form>
	</div>
</div>


<script type="text/javascript">
   $(document).ready( agregarFunciones );

  

//Ejecutar PHP
	var variableJs = 0;
	var campos = "<?php echo $campos ?>" - 1;
	variableJs = campos;
	var eltotal = 0;


function agregarFunciones(){

	//for
	//var i = 0;
	for (i = 1; i < campos+1 ; i++) {
	// 	 jQuery(document).ready(function($) { 
	//  $("#linea_"+ i + "").change(function(e) {
	// 	alert("Hola");
	// }
	// );
	// }

	//Impedir ingresar letras
    $("#cantidad_"+ i + "").keyup(function (){

        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
                
        //var total_sin_descuento = (eval($("#vu_"+ campos + "").val()) * eval($(this).val()));

        //Evaluar si descuento es diferente de cero
        if(eval($("#descuento_"+ i + "").val()) == "0")
        {
        	//Saber posición actual
        	var posicion = this.name.replace(/[^\d]/g, '');
        	
         	var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($("#descuento_"+ posicion + "").val())/ 100));
			 var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());        		
			var totalfila = ((eval($("#vu_"+ posicion + "").val())) * $("#cantidad_"+ posicion + "").val());        		
	         $("#vu_desc_"+ posicion + "").val(0);
	         $("#vt_con_desc_"+ posicion + "").val(0);
	         $("#total_"+ posicion + "").val(totalfila);
        }
        else
        {
        	// var importe_total = ((eval($("#vu_"+ campos + "").val()) * eval($(this).val())));
        	// //importe_total = importe_total + eval($("vu_"+ campos + "").val());
        	//  $("#total_"+ campos + "").val(importe_total);

        	var posicion = this.name.replace(/[^\d]/g, '');
       

	        //importe_total = importe_total + eval($("vu_"+ campos + "").val());
	        var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($("#desc_"+ posicion + "").val())/ 100));
	        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());
	        
	        //$("#total_"+ campos + "").val(importe_total);
	        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
	        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
	        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
	        $("#total_"+ posicion + "").val(total_con_descuento);

        }
        
        superTotal();
        
        //$("#vt_sin_desc_"+ campos + "").val(total_sin_descuento);
       

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#total_"+ posicion + "").val(0);		
	    	}

    });

	

    //DESCUENTO
    $("#desc_"+ i + "").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        
        //Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');
       

        //importe_total = importe_total + eval($("vu_"+ campos + "").val());
        var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($(this).val())/ 100));
        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());

        total_descuento = total_descuento.toFixed(2);
        total_con_descuento = total_con_descuento.toFixed(2);
        
        //$("#total_"+ campos + "").val(importe_total);
        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
        $("#total_"+ posicion + "").val(total_con_descuento);
        
        superTotal();

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#vu_desc_"+ i + "").val(0);		
	    	}

    });


	//DESCUENTO INVERSA
    $("#vu_desc_"+ i + "").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        
        //Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');
       

        var resta_valores = (eval($("#vu_"+ posicion + "").val()) - (eval($(this).val())));
        var porcentaje = ((resta_valores*100) / eval($("#vu_"+ posicion + "").val()));
        var total_descuento = (eval($("#vu_"+ posicion + "").val()) - eval($("#vu_desc_"+ posicion + "").val()));
        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());
        
        //$("#total_"+ campos + "").val(importe_total);
        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
        $("#desc_"+ posicion + "").val(porcentaje);
        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
        $("#total_"+ posicion + "").val(total_con_descuento);

        superTotal();

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#vu_desc_"+ i + "").val(0);		
	    	}

    });

	//Calculo de Super total
	function superTotal()
	{
		
		var total_principal = 0;
		for (var x = 0; x < 20; x++) {
			if (typeof $("#total_"+ x + "").val() != 'undefined') {
				total_principal = total_principal + eval($("#total_"+ x + "").val());
			}
		};
		$("#total").val(total_principal);
	}


    //Cargar Valores en el formulario
    //jQuery(document).ready(function($) {       
	$("#linea_" + i +"").change(function(e) {
		//alert("Hola");
		//Saber posición actual
        			var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=Presupuesto/precio",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){ 
                    

                          $("#resultado").empty();
                          //alert(data);
                          var variable = data;
                          $("#vu_" + posicion + "").val(variable);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#desc_" + posicion + "").val(0);
                          $("#vu_desc_" + posicion + "").val(0);
                          $("#vt_sin_desc_" + posicion + "").val(variable);
                          $("#vt_con_desc_" + posicion + "").val(0);
                          $("#total_" + posicion + "").val(variable);
                          superTotal();
                                                             
                    }
              });
        
    //$("#vu_" + campos + "").val($(this).val());
    $("#vu_" + i + "").val(variable);

    });

  	// }
  	// );
	} //Fin for
}


function agregarCampo(){
	campos = campos + 1;
	variableJs = campos;
	var NvoCampo= document.createElement("div");
	NvoCampo.id= "divcampo_"+(campos);
	NvoCampo.innerHTML= 
		"<table class='table'>" +
		"   <tr>" +
		"     <td nowrap='nowrap'>" +
		"		 <select name='linea_" + campos + "' id='linea_" + campos + "'>" +
		"			<option value=''></option>"+
		"			<?php foreach($lineasdeservicio as $linea_servicio){ ?>"+
		"			<option value='<?php echo $linea_servicio->id; ?>'><?php echo $linea_servicio->nombre; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' maxlength = 2 placeholder='Cantidad' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='V. Unitario' name='vu_" + campos + "' id='vu_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' maxlength = 3 placeholder='Descuento' name='desc_" + campos + "' id='desc_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='V.U Descuento' name='vu_desc_" + campos + "' id='vu_desc_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='Total sin Descuento' name='vt_sin_desc_" + campos + "' id='vt_sin_desc_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='Total con Descuento' name='vt_con_desc_" + campos + "' id='vt_con_desc_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='Total' name='total_" + campos + "' id='total_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);


    //Impedir ingresar letras
    $("#cantidad_"+ campos + "").keyup(function (){

        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
                
        //var total_sin_descuento = (eval($("#vu_"+ campos + "").val()) * eval($(this).val()));

        //Evaluar si descuento es diferente de cero
        if(eval($("#descuento_"+ campos + "").val()) == "0")
        {
        	//Saber posición actual
        	var posicion = this.name.replace(/[^\d]/g, '');
        	
         	var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($("#descuento_"+ posicion + "").val())/ 100));
			 var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());        		
			var totalfila = ((eval($("#vu_"+ posicion + "").val())) * $("#cantidad_"+ posicion + "").val());        		
	         $("#vu_desc_"+ posicion + "").val(0);
	         $("#vt_con_desc_"+ posicion + "").val(0);
	         $("#total_"+ posicion + "").val(totalfila);
        }
        else
        {
        	// var importe_total = ((eval($("#vu_"+ campos + "").val()) * eval($(this).val())));
        	// //importe_total = importe_total + eval($("vu_"+ campos + "").val());
        	//  $("#total_"+ campos + "").val(importe_total);

        	var posicion = this.name.replace(/[^\d]/g, '');
       

	        //importe_total = importe_total + eval($("vu_"+ campos + "").val());
	        var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($("#desc_"+ posicion + "").val())/ 100));
	        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());
	        
	        //$("#total_"+ campos + "").val(importe_total);
	        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
	        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
	        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
	        $("#total_"+ posicion + "").val(total_con_descuento);

        }
        
        superTotal();
        
        //$("#vt_sin_desc_"+ campos + "").val(total_sin_descuento);
       

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#total_"+ posicion + "").val(0);		
	    	}

    });

	

    //DESCUENTO
    $("#desc_"+ campos + "").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        
        //Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');
       

        //importe_total = importe_total + eval($("vu_"+ campos + "").val());
        var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($(this).val())/ 100));
        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());

        total_descuento = total_descuento.toFixed(2);
        total_con_descuento = total_con_descuento.toFixed(2);
        
        //$("#total_"+ campos + "").val(importe_total);
        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
        $("#total_"+ posicion + "").val(total_con_descuento);
        
        superTotal();

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#vu_desc_"+ campos + "").val(0);		
	    	}

    });


	//DESCUENTO INVERSA
    $("#vu_desc_"+ campos + "").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        
        //Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');
       

        var resta_valores = (eval($("#vu_"+ posicion + "").val()) - (eval($(this).val())));
        var porcentaje = ((resta_valores*100) / eval($("#vu_"+ posicion + "").val()));
        var total_descuento = (eval($("#vu_"+ posicion + "").val()) - eval($("#vu_desc_"+ posicion + "").val()));
        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());
        
        //$("#total_"+ campos + "").val(importe_total);
        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
        $("#desc_"+ posicion + "").val(porcentaje);
        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
        $("#total_"+ posicion + "").val(total_con_descuento);

        superTotal();

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#vu_desc_"+ campos + "").val(0);		
	    	}

    });

	//Calculo de Super total
	function superTotal()
	{
		var total_principal = 0;
		for (var i = 0; i < 20; i++) {
			if (typeof $("#total_"+ i + "").val() != 'undefined') {
				total_principal = total_principal + eval($("#total_"+ i + "").val());
			}
		};
		$("#total").val(total_principal);
	}


    //Cargar Valores en el formulario
    jQuery(document).ready(function($) {       
	$("#linea_" + campos +"").change(function(e) {
		//Saber posición actual
        			var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=Presupuesto/precio",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){ 
                    

                          $("#resultado").empty();
                          //alert(data);
                          var variable = data;
                          $("#vu_" + posicion + "").val(variable);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#desc_" + posicion + "").val(0);
                          $("#vu_desc_" + posicion + "").val(0);
                          $("#vt_sin_desc_" + posicion + "").val(variable);
                          $("#vt_con_desc_" + posicion + "").val(0);
                          $("#total_" + posicion + "").val(variable);
                          superTotal();
                                                             
                    }
              });
        
    //$("#vu_" + campos + "").val($(this).val());
    $("#vu_" + campos + "").val(variable);

    });

  	}
  	);
  }


function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
  var total_principal = 0;
		for (var i = 0; i < 20; i++) {
			if (typeof $("#total_"+ i + "").val() != 'undefined') {
				total_principal = total_principal + eval($("#total_"+ i + "").val());
			}
		};
		$("#total").val(total_principal);
  //variableJs = variableJs-1;
}

 function onEnviar(){
       document.getElementById("variable").value=variableJs;
       //document.getElementById("total").value=variableJs;
    }
</script>