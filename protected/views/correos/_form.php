<?php
/* @var $this CorreosController */
/* @var $model Correos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'correos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php 
			 $attribute='detalle';
				$this->widget('ext.redactor.ImperaviRedactorWidget',array(
				 'model'=>$model,
					'attribute'=>$attribute,
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
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pie'); ?>
		<?php 
			 $attribute='pie';
				$this->widget('ext.redactor.ImperaviRedactorWidget',array(
				 'model'=>$model,
					'attribute'=>$attribute,
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
		<?php echo $form->error($model,'pie'); ?>
	</div>
<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->