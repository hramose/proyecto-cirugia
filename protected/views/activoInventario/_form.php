<?php
/* @var $this ActivoInventarioController */
/* @var $model ActivoInventario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'activo-inventario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'activo_tipo_id'); ?>
			<?php echo $form->dropDownList($model, 'activo_tipo_id',CHtml::listData(ActivosTipo::model()->findAll("id > 0 order by 'tipo'"),'id','tipo'), array('class'=>'input-large'));?>
			<?php echo $form->error($model,'activo_tipo_id'); ?>
		</div>

		<div class="span8">
			<?php echo $form->labelEx($model,'nombre'); ?>
			<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'nombre'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'marca'); ?>
			<?php echo $form->textField($model,'marca',array('size'=>25,'maxlength'=>25)); ?>
			<?php echo $form->error($model,'marca'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'modelo'); ?>
			<?php echo $form->textField($model,'modelo',array('size'=>25,'maxlength'=>25)); ?>
			<?php echo $form->error($model,'modelo'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'serial'); ?>
			<?php echo $form->textField($model,'serial',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'serial'); ?>
		</div>
	</div>

	<div class="row">
	

	<div class="row">
		<?php echo $form->labelEx($model,'caracteristicas'); ?>
		<?php echo $form->textArea($model,'caracteristicas',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'caracteristicas'); ?>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'ubicacion'); ?>
			<?php echo $form->textField($model,'ubicacion',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'ubicacion'); ?>
		</div>

		<div class="span5">
			<?php //echo $form->labelEx($model,'estado'); ?>
			<?php //echo $form->dropDownList($model, 'estado',array('Activo'=>'Activo', 'Inactivo'=>'Inactivo'), array('class'=>'input-small'));?>
			<?php //echo $form->error($model,'estado'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->