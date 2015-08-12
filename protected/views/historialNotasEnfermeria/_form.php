<?php
/* @var $this HistorialNotasEnfermeriaController */
/* @var $model HistorialNotasEnfermeria */
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

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-notas-enfermeria-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); 

	$datosPaciente = Paciente::model()->find("id=$elPaciente");
	//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$datosPaciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

?>
<div class="row">
		<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$datosPaciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					array('name'=>'Edad', 'value'=>$edadpaciente, ''),
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$datosPaciente,
				'attributes'=>array(			
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		<div class="span1"></div>
	</div>

<input id='variable' name='variable' type='hidden' />

	<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Nota </a>
		<hr>
		<div class="row">
		<div class="span12">
		<table class "table" width="100%">
			<tr>
				<th width="0%"><small>Fecha</small></th>
				<th width="0%"><small>Hora</small></th>
				<th width="80%"><small>Nota</small></th>
				<th></th>
			</tr>
		</table>

	   <div id="contenedorcampos">
	   
	   </div>
	   </div>
	</div>

<hr>
<div class="row">
	<div class="span2"></div>
	<div class="span10">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>
</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

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
		"     <td nowrap='nowrap' width='12%'>" +
		"        <input type='text' class='input-small' autocomplete = 'off' placeholder='DD-MM-AAAA' name='fecha_" + campos + "' id='fecha_" + campos + "' onkeyup='mascara(this,\"-\",patron,true)' maxlength='10'>" +
		"     </td>" +
		"     <td nowrap='nowrap' width='20%'>" +
		"        <input type='text' class='input-mini' placeholder='' name='hora_" + campos + "' id='hora_" + campos + "' maxlength='7'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"		 <textarea rows='6' class = 'input-xxlarge' placeholder='' name ='nota_" + campos + "' id='nota_" + campos + "'></textarea>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	
	$("#variable").val(variableJs);

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);
    

	
    }

var patron = new Array(2,2,4);
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}

function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
}


</script>