<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */
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
		<?php echo $form->label($model,'producto_proveedor_id'); ?>
		<?php echo $form->textField($model,'producto_proveedor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'factura_n'); ?>
		<?php echo $form->textField($model,'factura_n',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forma_pago'); ?>
		<?php echo $form->textField($model,'forma_pago',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descuento'); ?>
		<?php echo $form->textField($model,'descuento',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descuento_tipo'); ?>
		<?php echo $form->textField($model,'descuento_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descuento_valor'); ?>
		<?php echo $form->textField($model,'descuento_valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descuento_total'); ?>
		<?php echo $form->textField($model,'descuento_total',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iva'); ?>
		<?php echo $form->textField($model,'iva',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iva_total'); ?>
		<?php echo $form->textField($model,'iva_total',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retencion_id'); ?>
		<?php echo $form->textField($model,'retencion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retencion_retener'); ?>
		<?php echo $form->textField($model,'retencion_retener',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retencion_base'); ?>
		<?php echo $form->textField($model,'retencion_base',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retencion_porcentaje'); ?>
		<?php echo $form->textField($model,'retencion_porcentaje',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_iva'); ?>
		<?php echo $form->textField($model,'rte_iva',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_iva_valor'); ?>
		<?php echo $form->textField($model,'rte_iva_valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_ica'); ?>
		<?php echo $form->textField($model,'rte_ica',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_ica_porcentaje'); ?>
		<?php echo $form->textField($model,'rte_ica_porcentaje',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_ica_valor'); ?>
		<?php echo $form->textField($model,'rte_ica_valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_productos'); ?>
		<?php echo $form->textField($model,'cantidad_productos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_orden'); ?>
		<?php echo $form->textField($model,'total_orden',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total'); ?>
		<?php echo $form->textField($model,'total',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_compra'); ?>
		<?php echo $form->textField($model,'total_compra',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'centro_costo_id'); ?>
		<?php echo $form->textField($model,'centro_costo_id'); ?>
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