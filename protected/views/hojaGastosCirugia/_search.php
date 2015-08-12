<?php
/* @var $this HojaGastosCirugiaController */
/* @var $model HojaGastosCirugia */
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
		<?php echo $form->label($model,'fecha_cirugia'); ?>
		<?php echo $form->textField($model,'fecha_cirugia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sala'); ?>
		<?php echo $form->textField($model,'sala'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'peso'); ?>
		<?php echo $form->textField($model,'peso',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_paciente'); ?>
		<?php echo $form->textField($model,'tipo_paciente',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_anestesia'); ?>
		<?php echo $form->textField($model,'tipo_anestesia',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_cirugia'); ?>
		<?php echo $form->textField($model,'tipo_cirugia',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cirugia'); ?>
		<?php echo $form->textField($model,'cirugia',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cirugia_codigo'); ?>
		<?php echo $form->textField($model,'cirugia_codigo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_ingreso'); ?>
		<?php echo $form->textField($model,'hora_ingreso',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_inicio_cirugia'); ?>
		<?php echo $form->textField($model,'hora_inicio_cirugia',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_final_cirugia'); ?>
		<?php echo $form->textField($model,'hora_final_cirugia',array('size'=>7,'maxlength'=>7)); ?>
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
		<?php echo $form->label($model,'rotadora_id'); ?>
		<?php echo $form->textField($model,'rotadora_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'instrumentadora_id'); ?>
		<?php echo $form->textField($model,'instrumentadora_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_productos'); ?>
		<?php echo $form->textField($model,'cantidad_productos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->