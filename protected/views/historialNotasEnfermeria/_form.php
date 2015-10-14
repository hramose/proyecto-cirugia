<?php
/* @var $this HistorialNotasEnfermeriaController */
/* @var $model HistorialNotasEnfermeria */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 

if(isset($_GET['idPaciente']))
{
	$elPaciente = $_GET['idPaciente'];
}
else
{
	$elPaciente = "0";
}

if(isset($_GET['idCita']))
{
	$laCita = $_GET['idCita'];
}
else
{
	$laCita = "0";
}

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-notas-enfermeria-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); 

	$datosPaciente = Paciente::model()->find("id=$elPaciente");
	//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$datosPaciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

?>
<div class="row">
		<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$datosPaciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					array('name'=>'Edad', 'value'=>$edadpaciente, ''),
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$datosPaciente,
				'attributes'=>array(			
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		<div class="span1"></div>
	</div>

<div class="row">
	<div class="span4">
		<?php echo $form->labelEx($model,'fecha_nota'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_nota',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_nota',
					'value'=> $model->fecha_nota,
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
		<?php echo $form->error($model,'fecha_nota'); ?>
	</div>
	<div class="span4">
		<?php echo $form->labelEx($model,'hora'); ?>
		<?php echo $form->textField($model,'hora',array('class'=>'input-small')); ?>
		<?php echo $form->error($model,'hora'); ?>
	</div>
</div>

<div class="row">
	<div class="span12">
		<?php echo $form->labelEx($model,'nota'); ?>
		<?php 
			 $attribute='nota';
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
		<?php echo $form->error($model,'nota'); ?>
	</div>
</div>




<hr>
<div class="row">
	<div class="span2"></div>
	<div class="span10">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>
</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->