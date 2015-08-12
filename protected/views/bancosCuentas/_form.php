<?php
/* @var $this BancosCuentasController */
/* @var $model BancosCuentas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bancos-cuentas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

<?php 
	$elBanco = Bancos::model()->findByPk($_GET['idBanco']);
?>

<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$elBanco,
			'attributes'=>array(
				'nombre',
			),
		)); ?>
	</div>
	<div class="span2"></div>
</div>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<input id='idBanco' name='idBanco' type='hidden' value= <?php echo $elBanco->id; ?>>
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado',array('Activo'=>'Activo','Inactivo'=>'Inactivo'), array('class'=>'input-small'));?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->