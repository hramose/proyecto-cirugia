<?php
/* @var $this HistorialMedicinaBiologicaController */
/* @var $model HistorialMedicinaBiologica */
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

if(isset($_GET['id']))
{
	$idMedicina = $_GET['id'];
}
else
{
	$idMedicina = "0";
}

$paciente = Paciente::model()->find("id=$elPaciente");

//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),
	
$medicamentos = MedicamentosBiologicos::model()->findAll(array("condition" => "id > 0", 'order'=>'medicamento asc'));
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

<?php 
if(isset($_GET['id']))
{
?>
<h3 class="text-center">Medicamentos Biológicos</h3>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<table class="table table-striped">
			<tr>
				<th>Ciclo</th>
				<th>Sesión</th>
				<th>Medicamento</th>
			</tr>
		<?php $losMedicamentos = HistorialMedicinaBiologicaDetalle::model()->findAll("historial_medicina_biologica_id = $model->id") ?>
		<?php 
			foreach ($losMedicamentos as $los_medicamentos) 
			{
				?>
				<tr>
					<td><b>Ciclo <?php echo $los_medicamentos->ciclo; ?></b></td>
					<td>Sesión <?php echo $los_medicamentos->sesion; ?></td>
					<td><?php echo $los_medicamentos->medicamentosBiologicos->medicamento; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
	</div>
	<div class="span2"></div>
	
</div>

<?php
}
?>


<?php

$elid = 0;
if(isset($_GET['id']))
{
$elCiclo = HistorialMedicinaBiologicaDetalle::model()->find(array("condition" => "id > 0"));
?>
<?php 
	$losCiclos = new HistorialMedicinaBiologicaDetalle;
	$criteria=new CDbCriteria;
	$criteria->select='max(ciclo) AS ciclo';
	$criteria->condition = "historial_medicina_biologica_id = $model->id";
	$row = $losCiclos->model()->find($criteria);
	$elid = $row['ciclo']+1;
	//$elid = $row['ciclo'];
?>
<h3 class="text-center">Ciclo <?php echo $elid; ?></h3>

<?php 
}else{
?>
<h3 class="text-center">Ciclo 1</h3>
<?php } ?>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<form id="Medicamento" name="Medicamento" action="index.php?r=HistorialMedicinaBiologica/guardarMedicina&idPaciente=<?php echo $elPaciente;?>&idCita=<?php echo $laCita; ?>&idMedicina=<?php echo $idMedicina;?>" method = "post" onsubmit="onEnviar()">
		    <a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Sesión </a>
			<hr>
			<table class "table" width="100%">
				<tr>
					<th width="90%">Medicina Biologíca</th>
					<th width="10%"></th>
				</tr>
			</table>

		   <div id="contenedorcampos">
		   
		   </div>
		   <?php 
		   if($elid == 1)
		   {
		   	?>
		   	<textarea rows='4' class = 'input-xxlarge' placeholder='Observaciones' name ='observaciones' id='observaciones'></textarea>
		   	<?php
		   }
		   ?>
		  
		  <div>
		  	<input id='variable' name='variable' type='hidden' />
		  	
		  </div>
		   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
		   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</form>
	</div>
	<div class="span2"></div>
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
			"		 <select class='input-xxlarge' name='medicamento_" + campos + "' id='medicamento_" + campos + "'>" +
			"			<option value=''></option>"+
			"			<?php foreach($medicamentos as $los_medicamentos){ ?>"+
			"			<option value='<?php echo $los_medicamentos->id; ?>'><?php echo $los_medicamentos->medicamento; ?></option>"+
			"			<?php } ?>"+
			"		 </select>"+
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

