<?php
/* @var $this TestimoniosController */
/* @var $model Testimonios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'testimonios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php 

	if(isset($_GET['idPaciente']))
	{
		$elPaciente = $_GET['idPaciente'];
	}
	else
	{
		$elPaciente = "0";
	}

	$paciente = Paciente::model()->find("id=$elPaciente"); 

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

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<div class="row">
	<div class="span10">
		<?php echo $form->labelEx($model,'testimonio'); ?>
		<?php echo $form->textArea($model,'testimonio',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'testimonio'); ?>
	</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<div class="input-prepend">
		<span class="add-on"><i class="icon-calendar"></i></span>
		<?php 			
			if ($model->fecha!='') {
					$lafecha=date('d-m-Y',strtotime($model->fecha));
			}else{$lafecha=null;}

					
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'fecha',
				'language'=>'es',
				'model' => $model,
				'attribute' => 'fecha',
				'value'=> $lafecha,						
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'language' => 'es',
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;width:80px;'
				),
			));
		?>
		</div>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->