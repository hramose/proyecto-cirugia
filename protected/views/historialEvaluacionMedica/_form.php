<?php
/* @var $this HistorialEvaluacionMedicaController */
/* @var $model HistorialEvaluacionMedica */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-evaluacion-medica-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

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
		$idCita = $_GET['idCita'];
	}
	else
	{
		$idCita = "0";
	}



	$paciente = Paciente::model()->find("id=$elPaciente"); 
	$tabla = HistorialTablaMedidas::model()->count("paciente_id = $elPaciente");

	//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

	$evolucion = "";
	$elHistorial = HistorialEvaluacionMedica::model()->findAll("paciente_id=$elPaciente");
	foreach ($elHistorial as $el_historial) 
		{
			$evolucion = $evolucion . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->evolucion."<br><br>";
		}

		//IMC mas reciente
		$cImc = HistorialExamenFisico::model()->count("paciente_id = $elPaciente");
		$elImc = HistorialExamenFisico::model()->find("paciente_id = $elPaciente");
		if ($cImc > 0) {
			$otroImc = $elImc->imc;
		}else{
			$otroImc = 0;
		}
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

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="span6">
			<?php //echo $form->labelEx($model,'personal_id'); ?>
			<?php //echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and id_perfil = 1"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
			<?php //echo $form->error($model,'personal_id'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span1"></div>
		<div class="span5 text-center">
		<?php
			$elimc = HistorialExamenFisico::model()->find("cita_id = $idCita");
		?>
			<h3 class="text-center">IMC: <span class="text-info"><?php echo $otroImc; ?></span></h3>
			<?php if ($tabla > 0) { ?>
			<a href="#tabla" role="button" class="btn btn-warning" data-toggle="modal">Ver Tabla de Medidas</a>
			<?php } ?>
		</div>
		<div class="span5">
		
		</div>
		<div class="span1"></div>
	</div>

	

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'evolucion'); ?>
			<?php echo $form->textArea($model,'evolucion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'evolucion'); ?>		
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Evolución</span>
			<pre><?php echo trim($evolucion); ?></pre>
		</div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->

<!-- Historial de Evaluación Cosmetológica -->
<?php if ($tabla > 0) { ?>
<div id="tabla" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tabla de Medidas</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$latabla = HistorialTablaMedidas::model()->find("paciente_id = $elPaciente"); 
 		
 		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$latabla,
			'attributes'=>array(
				'peso',
				'busto',
				'contorno',
				'cintura',
				'umbilical',
				'abd_inferior',
				'abd_superior',
				'cadera',
				'piernas',
				'muslo_derecho',
				'muslo_izquierdo',
				'brazo_derecho',
				'brazo_izquierdo',
			),
		)); 
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>