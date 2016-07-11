<?php
/* @var $this PacienteBaulController */
/* @var $model PacienteBaul */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paciente-baul-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php
$idPaciente = $_GET['idPaciente'];
	$paciente = Paciente::model()->find("id=$idPaciente");
?>

<div class="row">
	<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					'edad',
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		<div class="span1"></div>
	</div>
</div>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label>Adjunte los archivos</label>
		<div class="span8">
						<?php
					    $this->widget('ext.coco.CocoWidget'
					        ,array(
					            'id'=>'cocowidget1',
					            'onCompleted'=>'function(id,filename,jsoninfo){  }',
					            'onCancelled'=>'function(id,filename){ alert("cancelled"); }',
					            'onMessage'=>'function(m){ alert(m); }',
					            'allowedExtensions'=>array('jpg','png','doc', 'docx', 'pdf', 'xls', 'xlsx', 'tif'), // server-side mime-type validated
					            'sizeLimit'=>9000000, // limit in server-side and in client-side
					            'uploadDir' => 'adjuntos/', // coco will @mkdir it
					            // this arguments are used to send a notification
					            // on a specific class when a new file is uploaded,
					            'receptorClassName'=>'application.models.SubirArchivo',
					            'methodName'=>'onFileUploaded',
					            'userdata'=>$model->primaryKey,
					            'tipoFoto'=>'B',
					            // controls how many files must be uploaded
					            'maxUploads'=>10, // defaults to -1 (unlimited)
					            'maxUploadsReachMessage'=>'Ha superado la cantidad de archivos', // if empty, no message is shown
					            // controls how many files the can select (not upload, for uploads see also: maxUploads)
					            'multipleFileSelection'=>true, // true or false, defaults: true
					        ));
					    ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->