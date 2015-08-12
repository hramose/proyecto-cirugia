<?php
/* @var $this HistorialPlanTratamientoController */
/* @var $model HistorialPlanTratamiento */
/* @var $form CActiveForm */
?>

<div class="form">
<?php

	if(isset($_GET['idPaciente']))
	{
		$elPaciente = $_GET['idPaciente'];
	}
	else
	{
		$elPaciente = "0";
	}

	if(isset($_GET['idCita']))
	{
		$laCita = $_GET['idCita'];
	}
	else
	{
		$laCita = "0";
	}

	$paciente = Paciente::model()->find("id=$elPaciente");
		//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

	$lineas = LineaServicio::model()->findAll(array("condition" => "id > 0 and estado = 'activo'", 'order'=>'nombre asc'));
?>

<div class="row">
	<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					array('name'=>'Edad', 'value'=>$edadpaciente, ''),
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		<div class="span1"></div>
</div>

<div class="row">
		<div class="span1"></div>
		<div class="span8">
			<form id="Plan" name="Plan" action="index.php?r=HistorialPlanTratamiento/guardarPlan&idPaciente=<?php echo $elPaciente;?>&idCita=<?php echo $laCita; ?>" method = "post" onsubmit="onEnviar()">
			  

			    <a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Plan de Tratamiento </a>
				<hr>
				<table class "table" width="100%">
					<tr>
						<th width="45%">Linea de Servicio</th>
						<th width="45%">Observaciones</th>
						<th width="10%"></th>
					</tr>
				</table>

			   <div id="contenedorcampos">
			   
			   </div>
			  <textarea rows='4' class = 'input-xxlarge' placeholder='Observaciones' name ='observaciones' id='observaciones'></textarea>
			  <div>
			  	<input id='variable' name='variable' type='hidden' />
			  	
			  </div>
			   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
			   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</form>
		</div>
		<div class="span2"></div>
	</div>
	

</div>

</div><!-- form -->

<script type="text/javascript">
	   $(document).ready( agregarCampo );

		var variableJs = 0
		var campos = 1;
		var eltotal = 0;

	function agregarCampo(){
		campos = campos + 1;
		variableJs = campos;
		var NvoCampo= document.createElement("div");
		NvoCampo.id= "divcampo_"+(campos);
		NvoCampo.innerHTML= 
			"<table class='table'>" +
			"   <tr>" +
			"     <td nowrap='nowrap'>" +
			"		 <select name='lineas_" + campos + "' id='lineas_" + campos + "'>" +
			"			<option value=''></option>"+
			"			<?php foreach($lineas as $las_lineas){ ?>"+
			"			<option value='<?php echo $las_lineas->id; ?>'><?php echo $las_lineas->nombre; ?></option>"+
			"			<?php } ?>"+
			"		 </select>"+
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"        <input type='text' class='input-xxlarge' placeholder='Observaciones' name='observaciones_" + campos + "' id='observaciones_" + campos + "'>" +
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
			"     </td>" +
			"   </tr>" +
			"</table>";
		

		var contenedor= document.getElementById("contenedorcampos");
	    contenedor.appendChild(NvoCampo);
	  }


	function quitarCampo(iddiv){
	  var eliminar = document.getElementById("divcampo_" + iddiv);
	  var contenedor= document.getElementById("contenedorcampos");
	  contenedor.removeChild(eliminar);
	  superTotal();
	  //variableJs = variableJs-1;
	}

	 function onEnviar(){
	       document.getElementById("variable").value=variableJs;
	       //document.getElementById("total").value=variableJs;
	    }
	</script>