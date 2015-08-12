<?php
/* @var $this HistorialEvaluacionMedicaController */
/* @var $model HistorialEvaluacionMedica */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paciente_id'); ?>
		<?php echo $form->textField($model,'paciente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cita_id'); ?>
		<?php echo $form->textField($model,'cita_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnostico_principal_id'); ?>
		<?php echo $form->textField($model,'diagnostico_principal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnostico_relacional_id'); ?>
		<?php echo $form->textField($model,'diagnostico_relacional_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evolucion'); ?>
		<?php echo $form->textArea($model,'evolucion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->