<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $model HistorialFormulacionDetalle */
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
		<?php echo $form->label($model,'formulacion_id'); ?>
		<?php echo $form->textField($model,'formulacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otra_formulacion'); ?>
		<?php echo $form->textField($model,'otra_formulacion',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'formulacion'); ?>
		<?php echo $form->textArea($model,'formulacion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'historial_formulacion_id'); ?>
		<?php echo $form->textField($model,'historial_formulacion_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->