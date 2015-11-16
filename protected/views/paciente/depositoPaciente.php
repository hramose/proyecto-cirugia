<?php

//$idContrato = $_GET['idContrato'];

$this->menu=array(
	//array('label'=>'Listar Contrato', 'url'=>array('index')),
	//array('label'=>'Actualizar Contrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Regresar a Caja de Paciente', 'url'=>array('index.php/pacienteMovimientos/viewCaja&id='.$model->id)),
);
?>
<h1>Traslado de Fondos a Paciente</h1>

<h5>Se dispone a realizar un fondos a otro paciente. Seleccione el destinatario</h5>

<div class="row">
	<div class="span12"></div>
</div>

<form name="depositoContrato" action="index.php?r=paciente/ingresoCajaPaciente&idOrigen=<?php echo $model->id;?>" method = "post" >
	<div class="row">
		<div class="span1"></div>	
		<div class="span10">
			<label>Pacientes Disponibles</label>
			<select name="paciente" id="paciente" class="input-xxlarge">
				<?php 
					$losPacientes = Paciente::model()->findAll(array('order'=>'nombre'));
					foreach ($losPacientes as $los_pacientes) 
					{
						echo "<option value=$los_pacientes->id>$los_pacientes->nombreCompleto - $los_pacientes->n_identificacion</option>";
					}
				?>
			</select>
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
			<h4>Monto del ingreso:</h4>
			<div class="input-prepend input-append control-group info">
				<span class="add-on">$</span>
				<input type="text" class="input-small" name="valor" id="valor" value="">
			</div>
		</div>	
		<div class="span3"></div>	
	</div>
	<hr>
	<div class="row">
		<div class="span10 text-center">
			<input type="submit" value="Aplicar" name="Aplicar" class="btn btn-warning">
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

</script>