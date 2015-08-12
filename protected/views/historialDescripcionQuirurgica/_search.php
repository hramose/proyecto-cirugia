<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $model HistorialDescripcionQuirurgica */
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
		<?php echo $form->label($model,'servicio'); ?>
		<?php echo $form->textField($model,'servicio',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnostico_preoperatorio'); ?>
		<?php echo $form->textArea($model,'diagnostico_preoperatorio',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnostico_posoperatorio'); ?>
		<?php echo $form->textArea($model,'diagnostico_posoperatorio',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cirujano_id'); ?>
		<?php echo $form->textField($model,'cirujano_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ayudante_id'); ?>
		<?php echo $form->textField($model,'ayudante_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anestesiologo_id'); ?>
		<?php echo $form->textField($model,'anestesiologo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inst_quirurgico_id'); ?>
		<?php echo $form->textField($model,'inst_quirurgico_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_cirugia'); ?>
		<?php echo $form->textField($model,'fecha_cirugia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_inicio'); ?>
		<?php echo $form->textField($model,'hora_inicio',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_final'); ?>
		<?php echo $form->textField($model,'hora_final',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_cups'); ?>
		<?php echo $form->textField($model,'codigo_cups',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'intervencion'); ?>
		<?php echo $form->textField($model,'intervencion',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'control_compresas'); ?>
		<?php echo $form->textField($model,'control_compresas',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_anestesia'); ?>
		<?php echo $form->textField($model,'tipo_anestesia',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion_hallazgos'); ?>
		<?php echo $form->textArea($model,'descripcion_hallazgos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
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