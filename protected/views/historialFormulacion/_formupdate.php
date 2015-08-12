<?php
/* @var $this HistorialFormulacionController */
/* @var $model HistorialFormulacion */
/* @var $form CActiveForm */
?>

<?php

$elPaciente = $model->paciente_id;
$paciente = Paciente::model()->find("id=$elPaciente");
$formulaciones = Formulacion::model()->findAll(array("condition" => "id > 0", 'order'=>'nombre asc'));
$registros = HistorialFormulacionDetalle::model()->findAll("historial_formulacion_id = $model->id")
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
					'edad',
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

<div class="row text-center">
	<div class="span12">
		<a class="btn btn-small btn-warning" href='index.php?r=paciente/view&id=<?php echo $model->id;?>'><i class="icon-search icon-white"></i> Ficha de Paciente</a>
	</div>
</div>

<div class="row">
	<div class="span11">
		<form id="Formulacion" name="Formulacion" action="index.php?r=HistorialFormulacion/actualizarFormulacion&id=<?php echo $model->id;?>&idPaciente=<?php echo $elPaciente;?>&idCita=<?php echo $model->cita_id; ?>" method = "post" onsubmit="onEnviar()">
		  

		    <a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Formulación </a>
			<hr>
			<table class "table  width='100%'">
				<tr>
					<th width="20%">Formula</th>
					<th width="25%">Otra Formula</th>
					<th width="0%">Formulación</th>
					<th width="0%"></th>
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
					 <select name='formula_<?php echo $campos ?>' id='formula_<?php echo $campos ?>'>
						<option value=''></option>
						<?php foreach($formulaciones as $las_formulaciones){
						if ($las_formulaciones->id == $losregistros->formulacion_id) {
						?>
						<option selected value='<?php echo $las_formulaciones->id; ?>'><?php echo $las_formulaciones->nombre; ?></option>
						<?php
						}
						else
						{
						?>
						<option value='<?php echo $las_formulaciones->id; ?>'><?php echo $las_formulaciones->nombre; ?></option>
						<?php
						}
						?>
						<?php } ?>
					 </select>
			     </td>
			     <td nowrap='nowrap'>
			        <input type='text' class='input-large' placeholder='Otra' name='otra_<?php echo $campos ?>' id='otra_<?php echo $campos ?>' value='<?php echo $losregistros->otra_formulacion ?>'>
			     </td>
			     <td nowrap='nowrap'>
				  	<textarea rows='4' class = 'input-xxlarge' placeholder='Formulación' name ='formulacion_<?php echo $campos ?>' id='formulacion_<?php echo $campos ?>'><?php echo $losregistros->formulacion ?></textarea
			     </td>
			     <td nowrap='nowrap'>
			        <a href='JavaScript:quitarCampo(<?php echo $campos; ?>);' class='btn btn-mini btn-danger'> [x] </a>
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
		  	<input id='variable' name='variable' type='hidden' />
		  	
		  </div>
		   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
		   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</form>
	</div>
</div>


<script type="text/javascript">
  // $(document).ready( agregarCampo );

	var variableJs = 0
	var campos = "<?php echo $campos ?>" - 1;
	variableJs = campos;
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
		"		 <select name='formula_" + campos + "' id='formula_" + campos + "'>" +
		"			<option value=''></option>"+
		"			<?php foreach($formulaciones as $las_formulaciones){ ?>"+
		"			<option value='<?php echo $las_formulaciones->id; ?>'><?php echo $las_formulaciones->nombre; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-large' placeholder='Otra' name='otra_" + campos + "' id='otra_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"	  	<textarea rows='4' class = 'input-xxlarge' placeholder='Formulación' name ='formulacion_" + campos + "' id='formulacion_" + campos + "'></textarea>"+
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