<?php
/* @var $this CentroCostoController */
/* @var $model CentroCosto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'centro-costo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>25,'maxlength'=>25, 'class'=>'input-xlarge')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'tipo'); ?>
			<?php echo $form->dropDownList($model, 'tipo',array('Ingreso'=>'Ingreso','Egreso'=>'Egreso'));?>
			<?php echo $form->error($model,'tipo'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'estado'); ?>
			<?php echo $form->dropDownList($model, 'estado',array('Activo'=>'Activo','Inactivo'=>'Inactivo'));?>	
			<?php echo $form->error($model,'estado'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-warning')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->