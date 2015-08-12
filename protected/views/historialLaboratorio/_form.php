<?php
/* @var $this HistorialLaboratorioController */
/* @var $model HistorialLaboratorio */
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
$laboratorios = Laboratorio::model()->findAll(array("condition" => "id > 0", 'order'=>'nombre asc'));
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
	<div class="span2"></div>
	<div class="span8">
		<form id="Formulacion" name="Formulacion" action="index.php?r=HistorialLaboratorio/guardarLaboratorio&idPaciente=<?php echo $elPaciente;?>&idCita=<?php echo $laCita; ?>" method = "post" onsubmit="onEnviar()">
		  

		    <a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Examen </a>
			<hr>
			<table class "table" width="100%">
				<tr>
					<th width="45%">Examen</th>
					<th width="45%">Descripción</th>
					<th width="10%"></th>
				</tr>
			</table>

		   <div id="contenedorcampos">
		   
		   </div>
		  <textarea rows='4' class = 'input-xxlarge' placeholder='Comentarios' name ='comentarios' id='comentarios'></textarea>
		  <div>
		  	<input id='variable' name='variable' type='hidden' />
		  	
		  </div>
		   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
		   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</form>
	</div>
	<div class="span2"></div>
</div>


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
			"		 <select name='laboratorio_" + campos + "' id='laboratorio_" + campos + "'>" +
			"			<option value=''></option>"+
			"			<?php foreach($laboratorios as $los_laboratorios){ ?>"+
			"			<option value='<?php echo $los_laboratorios->id; ?>'><?php echo $los_laboratorios->nombre; ?></option>"+
			"			<?php } ?>"+
			"		 </select>"+
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"        <input type='text' class='input-large' placeholder='Examen' name='examen_" + campos + "' id='examen_" + campos + "'>" +
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

