<?php
/* @var $this VentasController */
/* @var $model Ventas */
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
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sub_total'); ?>
		<?php echo $form->textField($model,'sub_total',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_iva'); ?>
		<?php echo $form->textField($model,'total_iva',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descuento'); ?>
		<?php echo $form->textField($model,'descuento',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descuento_tipo'); ?>
		<?php echo $form->textField($model,'descuento_tipo',array('size'=>1,'maxlength'=>1)); ?>
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
		<?php echo $form->label($model,'cant_productos'); ?>
		<?php echo $form->textField($model,'cant_productos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_orden'); ?>
		<?php echo $form->textField($model,'total_orden',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forma_pago'); ?>
		<?php echo $form->textField($model,'forma_pago',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dinero_recibido'); ?>
		<?php echo $form->textField($model,'dinero_recibido',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dinero_cambio'); ?>
		<?php echo $form->textField($model,'dinero_cambio',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_venta'); ?>
		<?php echo $form->textField($model,'total_venta',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credito_dias'); ?>
		<?php echo $form->textField($model,'credito_dias'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credito_fecha'); ?>
		<?php echo $form->textField($model,'credito_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cheques_cantidad'); ?>
		<?php echo $form->textField($model,'cheques_cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cheques_cuenta_banco'); ?>
		<?php echo $form->textField($model,'cheques_cuenta_banco'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_tipo'); ?>
		<?php echo $form->textField($model,'tarjeta_tipo',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_aprobacion'); ?>
		<?php echo $form->textField($model,'tarjeta_aprobacion',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_entidad'); ?>
		<?php echo $form->textField($model,'tarjeta_entidad',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_cuenta_banco'); ?>
		<?php echo $form->textField($model,'tarjeta_cuenta_banco'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consignacion_cuenta_banco'); ?>
		<?php echo $form->textField($model,'consignacion_cuenta_banco'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consignacion_banco'); ?>
		<?php echo $form->textField($model,'consignacion_banco',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consignacion_cuenta'); ?>
		<?php echo $form->textField($model,'consignacion_cuenta',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personal'); ?>
		<?php echo $form->textField($model,'personal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_hora'); ?>
		<?php echo $form->textField($model,'fecha_hora'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->