<?php
/* @var $this ProductoInventarioController */
/* @var $model ProductoInventario */
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
		<?php echo $form->label($model,'nombre_producto'); ?>
		<?php echo $form->textField($model,'nombre_producto',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'producto_referencia'); ?>
		<?php echo $form->textField($model,'producto_referencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costo_iva'); ?>
		<?php echo $form->textField($model,'costo_iva',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'precio_publico'); ?>
		<?php echo $form->textField($model,'precio_publico',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iva'); ?>
		<?php echo $form->textField($model,'iva',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'producto_presentacion_id'); ?>
		<?php echo $form->textField($model,'producto_presentacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'producto_unidad_medida_id'); ?>
		<?php echo $form->textField($model,'producto_unidad_medida_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stock_minimo'); ?>
		<?php echo $form->textField($model,'stock_minimo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'producto_proveedor_id'); ?>
		<?php echo $form->textField($model,'producto_proveedor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_inventario'); ?>
		<?php echo $form->textField($model,'tipo_inventario',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'producto_categoria_id'); ?>
		<?php echo $form->textField($model,'producto_categoria_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>20,'maxlength'=>20)); ?>
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