<?php
/* @var $this DiagnosticoPrincipalController */
/* @var $model DiagnosticoPrincipal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'diagnostico-principal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span10">
			<?php echo $form->labelEx($model,'diagnostico'); ?>
			<?php echo $form->textField($model,'diagnostico',array('size'=>50,'maxlength'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'diagnostico'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->