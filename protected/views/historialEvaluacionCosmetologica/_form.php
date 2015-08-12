<?php
/* @var $this HistorialEvaluacionCosmetologicaController */
/* @var $model HistorialEvaluacionCosmetologica */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-evaluacion-cosmetologica-form',
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

	//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

	$evaluacion = "";
	$elHistorial = HistorialEvaluacionCosmetologica::model()->findAll("paciente_id=$elPaciente");
	foreach ($elHistorial as $el_historial) 
		{
			$evaluacion = $evaluacion . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->evaluacion."<br><br>";
		}

	?>

	<div class="row">
		<h4 class="text-center">Datos de Paciente</h4>
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
		<div class="span12"></div>
	</div>

	<?php echo $form->errorSummary($model); ?>
	
	<!-- <div class="row">
		<div class="span6">
			<?php //echo $form->labelEx($model,'personal_id'); ?>
			<?php //echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and id_perfil = 1"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
			<?php //echo $form->error($model,'personal_id'); ?>
		</div>
	</div> -->
	
	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'evaluacion'); ?>
			<?php echo $form->textArea($model,'evaluacion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'evaluacion'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Evolución</span>
			<pre><?php echo trim($evaluacion); ?></pre>

		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->