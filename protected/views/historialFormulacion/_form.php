<?php
/* @var $this HistorialFormulacionController */
/* @var $model HistorialFormulacion */
/* @var $form CActiveForm */
?>

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

$model = Paciente::model()->find("id=$elPaciente");

	//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$model->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),
$formulaciones = Formulacion::model()->findAll(array("condition" => "id > 0", 'order'=>'nombre asc'));
?>
<div class="row">
		<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					array('name'=>'Edad', 'value'=>$edadpaciente, ''),
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
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
		<form id="Formulacion" name="Formulacion" action="index.php?r=HistorialFormulacion/guardarFormulacion&idPaciente=<?php echo $elPaciente;?>&idCita=<?php echo $laCita; ?>" method = "post" onsubmit="onEnviar()">
		  

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