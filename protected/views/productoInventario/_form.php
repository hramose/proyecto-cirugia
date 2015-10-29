<?php
/* @var $this ProductoInventarioController */
/* @var $model ProductoInventario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-inventario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'nombre_producto'); ?>
			<?php echo $form->textField($model,'nombre_producto',array('size'=>60,'maxlength'=>75, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'nombre_producto'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'producto_referencia'); ?>
			<?php echo $form->textField($model,'producto_referencia',array('size'=>25,'maxlength'=>25, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'producto_referencia'); ?>
		</div>
	</div>

<div class="row">
	<div class="form-actions">
		<div class="span3"></div>
		<div class="span3">
			<?php echo $form->labelEx($model,'iva'); ?>
			<?php echo $form->textField($model,'iva',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'iva'); ?>
		</div>
		<div class="span3">
			<?php echo $form->labelEx($model,'precio_publico'); ?>
			<?php echo $form->textField($model,'precio_publico',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'precio_publico'); ?>
		</div>
	</div>
</div>



	<div class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'producto_presentacion_id'); ?>
			<?php echo $form->dropDownList($model, 'producto_presentacion_id',CHtml::listData(ProductoPresentacion::model()->findAll("id > 0 order by 'presentacion'"),'id','presentacion'), array('class'=>'input-large'));?>
			<?php echo $form->error($model,'producto_presentacion_id'); ?>
		</div>
		<div class="span1"></div>

		<div class="span3">
			<?php echo $form->labelEx($model,'producto_unidad_medida_id'); ?>
			<?php echo $form->dropDownList($model, 'producto_unidad_medida_id',CHtml::listData(ProductoUnidadMedida::model()->findAll("id > 0 order by 'medida'"),'id','medida'), array('class'=>'input-large'));?>
			<?php echo $form->error($model,'producto_unidad_medida_id'); ?>
		</div>
		<div class="span1"></div>
		<div class="span2">
			<?php echo $form->labelEx($model,'stock_minimo'); ?>
			<?php echo $form->textField($model,'stock_minimo', array('class'=>'input-mini')); ?>
			<?php echo $form->error($model,'stock_minimo'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'producto_proveedor_id'); ?>
			<?php echo $form->dropDownList($model, 'producto_proveedor_id',CHtml::listData(ProductoProveedor::model()->findAll("id > 0 order by 'nombre'"),'id','nombre'), array('class'=>'input-xlarge'));?>
			<?php echo $form->error($model,'producto_proveedor_id'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'tipo_inventario'); ?>
			<?php echo $form->dropDownList($model, 'tipo_inventario',array('Productos'=>'Productos','Insumos'=>'Insumos', 'Consumibles'=>'Consumibles'));?>	
			<?php echo $form->error($model,'tipo_inventario'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'producto_categoria_id'); ?>
			<?php echo $form->dropDownList($model, 'producto_categoria_id',CHtml::listData(ProductoCategoria::model()->findAll("id > 0 order by 'categoria'"),'id','categoria'), array('class'=>'input-xlarge'));?>
			<?php echo $form->error($model,'producto_categoria_id'); ?>
		</div>
	</div>

	<?php //Mostrar solo si es Modificación ?>

	<?php 
		if (!$model->isNewRecord) {
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado',array('Activo'=>'Activo','Inactivo'=>'Inactivo'), array('class'=>'input-small'));?>	
		<?php echo $form->error($model,'estado'); ?>
	</div>
	
	<?php		
		}
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->