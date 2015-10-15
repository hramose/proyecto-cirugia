<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promociones-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'fecha_inicio'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_inicio',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_inicio',
					'value'=> $model->fecha_inicio,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'2014:2025',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				)); ?>
			<?php echo $form->error($model,'fecha_inicio'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'fecha_fin'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_fin',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_fin',
					'value'=> $model->fecha_fin,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'2014:2025',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				)); ?>
			<?php echo $form->error($model,'fecha_fin'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'titulo_promocion'); ?>
			<?php echo $form->textField($model,'titulo_promocion',array('size'=>60,'maxlength'=>100, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'titulo_promocion'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'promocion'); ?>
			<?php 
				 $attribute='promocion';
					$this->widget('ext.redactor.ImperaviRedactorWidget',array(
					 'model'=>$model,
						'attribute'=>$attribute,
						//'selector'=>'.redactor',
						'options'=>array(
							'lang'=>'es',
							 'width'=>'900',
		   			          'height'=>'250',

						    'fileUpload'=>Yii::app()->createUrl('post/fileUpload',array(
						        'attr'=>$attribute
						    )),
						    'fileUploadErrorCallback'=>new CJavaScriptExpression(
						        'function(obj,json) { alert(json.error); }'
						    ),
						    'imageUpload'=>Yii::app()->createUrl('post/imageUpload',array(
						        'attr'=>$attribute
						    )),
						    'imageGetJson'=>Yii::app()->createUrl('post/imageList',array(
						        'attr'=>$attribute
						    )),
						    'imageUploadErrorCallback'=>new CJavaScriptExpression(
						        'function(obj,json) { alert(json.error); }'
						    ),
						),
						));
			?>
			<?php echo $form->error($model,'promocion'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado',array('Activa'=>'Activa', 'Vencida'=>'Vencida'), array('class'=>'input-small'));?>	
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->