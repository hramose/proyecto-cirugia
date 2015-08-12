<?php
/* @var $this PacienteFotografiasController */
/* @var $model PacienteFotografias */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paciente-fotografias-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php
if(isset($_GET['idPaciente']))
{
	$elPaciente = $_GET['idPaciente'];
}
else
{
	$elPaciente = "0";
}

$paciente = Paciente::model()->find("id=$elPaciente");
$laboratorios = Laboratorio::model()->findAll(array("condition" => "id > 0", 'order'=>'nombre asc'));
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


	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<!-- Agregar Archivos -->
<div class="row">
		<div class="span8">
						<?php
					    $this->widget('ext.coco.CocoWidget'
					        ,array(
					            'id'=>'cocowidget1',
					            'onCompleted'=>'function(id,filename,jsoninfo){  }',
					            'onCancelled'=>'function(id,filename){ alert("cancelled"); }',
					            'onMessage'=>'function(m){ alert(m); }',
					            'allowedExtensions'=>array('jpg','png'), // server-side mime-type validated
					            'sizeLimit'=>2000000, // limit in server-side and in client-side
					            'uploadDir' => 'adjuntos/', // coco will @mkdir it
					            // this arguments are used to send a notification
					            // on a specific class when a new file is uploaded,
					            'receptorClassName'=>'application.models.SubirArchivo',
					            'methodName'=>'onFileUploaded',
					            'userdata'=>$model->primaryKey,
					            'tipoFoto'=>'T',
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
		<div class="span12"></div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->