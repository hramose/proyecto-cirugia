<?php

//$idContrato = $_GET['idContrato'];

$this->menu=array(
	//array('label'=>'Listar Contrato', 'url'=>array('index')),
	//array('label'=>'Actualizar Contrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Regresar a Caja de Paciente', 'url'=>array('pacienteMovimientos/viewCaja&id='.$model->id)),
);
?>
<h1>Traslado de Fondos a Paciente</h1>

<h5>Se dispone a realizar un fondos a otro paciente. Seleccione el destinatario</h5>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
	<p><b>Cuenta de Origen:</b></p>
	<?php
	$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(			
				'nombre',
				'apellido',
				'n_identificacion',
			),
		));
	?>
	</div>
</div>
<br>

<form name="depositoContrato" action="index.php?r=paciente/ingresoCajaPaciente&idOrigen=<?php echo $model->id;?>" method = "post" onsubmit = "return onEnviar()">
	<div class="row">
		<div class="span1"></div>	
		<div class="span10">
			<label>Pacientes Disponibles</label>
			<?php 
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					    //'model'=>$model,
					    //'attribute'=>'name',
					    'id'=>'buscar_paciente',
					    //'id'=>'country-chain',
					    'name'=>'buscar_paciente',
					    //'name'=>'country_chain',
					    'source'=>$this->createUrl('pacienteBuscar/buscarPaciente'),
					    'options'=>array(
					        'delay'=>300,
					        'minLength'=>2,
					        'showAnim'=>'fold',
					        'select'=>"js:function(event, ui) {
					            $('#nombre_paciente').val(ui.item.nombre);
					            $('#paciente').val(ui.item.id)
					            
					        }"
					    ),
					    'htmlOptions'=>array(
					        'size'=>'100',
					        'class'=>'input-small',
					    ),
					));
			?>
			- 
			<input type="text" class="input-xxlarge" readonly="true" id="nombre_paciente" name="nombre_paciente">
			<div style="display: none">
				<input type="text" class="input-small" id="paciente" name="paciente">	
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="span1"></div>	
		<div class="span4 text-center hero-unit">
			<img class="img" src="images/tunquito.png"/>
			<h4>Disponible en caja:</h4>
			<div class="input-prepend input-append">
				<span class="add-on">$</span>
				<input type="text" class="input-small" readonly="true" name="saldo" id="saldo" value="<?php echo $model->saldo; ?>">
			</div>
		</div>	
		<div class="span4 text-center hero-unit">
			<img class="img" src="images/MoneyTransfer.png"/>
			<h4>Monto de transferencia:</h4>
			<div class="input-prepend input-append control-group info">
				<span class="add-on">$</span>
				<input type="text" class="input-small" name="valor" id="valor" value="">
			</div>
		</div>	
		<div class="span3"></div>	
	</div>

	<div class="row">
		<div class="span2"></div>
		<div class="span9">
			<label for="">Comentario:</label>
			<textarea name="comentario" id="comentario" cols="30" rows="3" class="input-xxlarge"></textarea>
		</div>	
	</div>
	
	<hr>
	<div class="row">
		<div class="span10 text-center">
			<input type="submit" value="Aplicar" name="Aplicar" class="btn btn-warning" onclick="js:antesdeEnviar()">
		</div>
	</div>
</form>

<script>
	
    $("#valor").keyup(function (){
    	//Impedir ingresar letras
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#valor").val(0);		
	    	}

	    //Verificar que no supere valor de saldo en caja
	    if ($(this).val() > eval($("#saldo").val()))
	    	{
	    		swal("Valor de ingreso no puede superar el saldo de caja.");
	    		
	    		document.depositoContrato.Aplicar.disabled=true; 
	    		$("#saldo").setfocus();
	    	}
	    	else
	    	{
	    		document.depositoContrato.Aplicar.disabled=false; 
	    	}

	    //Verificar que no supere valor de saldo de contrato
	    if ($(this).val() > eval($("#saldo_contrato").val()))
	    	{
	    		swal("Valor de ingreso superar el saldo de contrato.");
	    		
	    		document.depositoContrato.Aplicar.disabled=true; 
	    		$("#saldo").setfocus();
	    	}
	    	else
	    	{
	    		document.depositoContrato.Aplicar.disabled=false; 
	    	}

    });

function onEnviar()
{
	if($('#valor').val() == 0 || $('#valor').val() == "")
	{
		swal("Establezca el valor del traslado.");
		return false;
	}

	if($('#paciente').val() == "")
	{
		swal("Seleccione paciente para realizar traslado.");
		return false;
	}

	

}

</script>