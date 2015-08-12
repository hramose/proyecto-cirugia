<?php
/* @var $this HistorialAnamnesisController */
/* @var $model HistorialAnamnesis */
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
		<?php echo $form->label($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'motivo_consulta'); ?>
		<?php echo $form->textArea($model,'motivo_consulta',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enfermedad_actual'); ?>
		<?php echo $form->textArea($model,'enfermedad_actual',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_patologico'); ?>
		<?php echo $form->textArea($model,'antecedente_patologico',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_quirurgico'); ?>
		<?php echo $form->textArea($model,'antecedente_quirurgico',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_alergico'); ?>
		<?php echo $form->textArea($model,'antecedente_alergico',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_traumatico'); ?>
		<?php echo $form->textArea($model,'antecedente_traumatico',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_medicamento'); ?>
		<?php echo $form->textArea($model,'antecedente_medicamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_ginecologico'); ?>
		<?php echo $form->textArea($model,'antecedente_ginecologico',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_fum'); ?>
		<?php echo $form->textArea($model,'antecedente_fum',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_habitos'); ?>
		<?php echo $form->textArea($model,'antecedente_habitos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_familiares'); ?>
		<?php echo $form->textArea($model,'antecedente_familiares',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'antecedente_nutricionales'); ?>
		<?php echo $form->textArea($model,'antecedente_nutricionales',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observaciones_paciente'); ?>
		<?php echo $form->textArea($model,'observaciones_paciente',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->