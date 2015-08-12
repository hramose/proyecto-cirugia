<?php
/* @var $this EgresosController */
/* @var $model Egresos */
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
		<?php echo $form->label($model,'proveedor_id'); ?>
		<?php echo $form->textField($model,'proveedor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'factura_id'); ?>
		<?php echo $form->textField($model,'factura_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forma_pago'); ?>
		<?php echo $form->textField($model,'forma_pago',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_pronto_pago'); ?>
		<?php echo $form->textField($model,'desc_pronto_pago',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_pronto_pago_tipo'); ?>
		<?php echo $form->textField($model,'desc_pronto_pago_tipo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_pronto_pago_valor'); ?>
		<?php echo $form->textField($model,'desc_pronto_pago_valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iva_porcentace'); ?>
		<?php echo $form->textField($model,'iva_porcentace',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor_egreso'); ?>
		<?php echo $form->textField($model,'valor_egreso',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_descuento'); ?>
		<?php echo $form->textField($model,'total_descuento',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iva_valor'); ?>
		<?php echo $form->textField($model,'iva_valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_aplica'); ?>
		<?php echo $form->textField($model,'rte_aplica',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retencion_id'); ?>
		<?php echo $form->textField($model,'retencion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'a_retener'); ?>
		<?php echo $form->textField($model,'a_retener',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_base'); ?>
		<?php echo $form->textField($model,'rte_base',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_porcenaje'); ?>
		<?php echo $form->textField($model,'rte_porcenaje',array('size'=>10,'maxlength'=>10)); ?>
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
		<?php echo $form->label($model,'rte_cree'); ?>
		<?php echo $form->textField($model,'rte_cree',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_cree_porcentaje'); ?>
		<?php echo $form->textField($model,'rte_cree_porcentaje',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rte_cree_valor'); ?>
		<?php echo $form->textField($model,'rte_cree_valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'centro_costo_id'); ?>
		<?php echo $form->textField($model,'centro_costo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_egreso'); ?>
		<?php echo $form->textField($model,'total_egreso',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->