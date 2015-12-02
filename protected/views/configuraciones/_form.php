<?php
/* @var $this ConfiguracionesController */
/* @var $model Configuraciones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configuraciones-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'super_usuario'); ?>
		<?php echo $form->textField($model,'super_usuario',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'super_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clave_exportar'); ?>
		<?php echo $form->textField($model,'clave_exportar',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'clave_exportar'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->