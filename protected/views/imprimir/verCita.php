<!DOCTYPE html>
<html lang="es">
  <head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="language" content="es" />
</head>
<?php
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  Yii::app()->clientScript->registerCoreScript('jquery');

  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
  $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
  $cs->registerCssFile($baseUrl.'/css/abound.css');
?>


<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-purple.css" />
<?php
$model = Citas::model()->findByPK($_GET['id']);
?>



<div class="row">
	<div class="span1"></div>
	<div class="span10">
		<h1>Cita #<?php echo $model->id; ?></h1>
		<?php 
		if ($model->fecha_cita!='') {
				$fecha_cita=date('d-m-Y',strtotime($model->fecha_cita));
		}else{$fecha_cita=null;}
		if ($model->fecha_confirmacion!='') {
				$fecha_confirmacion=date('d-m-Y',strtotime($model->fecha_confirmacion));
		}else{$fecha_confirmacion=null;}
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'paciente.nombreCompleto',
				array('name'=> 'Especialista', 'value'=>$model->personal->nombreCompleto),
				'paciente_orden_id',
				array('name'=> 'Linea de Servicio', 'value'=>$model->lineaServicio->nombre),
				'estado',
				array('name'=>'Fecha de Cita', 'value'=>$fecha_cita,''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$model->horaFin->hora,''),
				'comentario',
				'confirmacion',
				array('name'=>'Fecha de confirmacion', 'value'=>$fecha_confirmacion,''),
				array('name'=>'Agendado por', 'value'=>$model->usuario->nombreCompleto, ''),

			),
		)); ?>
		<?php if ($model->usuario_estado_id != NULL): ?>
			<h4 class="text-center">Usuario que finalizo esta cita: <span class='text-info'><?php echo $model->usuarioEstado->nombreCompleto; ?></span></h4>	
		<?php endif ?>
	</div>
	<div class="span1"></div>


</div>

<div class="row">
	<div class="span1"></div>
	<div class="span10">
		<h1>Datos de Paciente</h1>
		<?php
		if ($model->paciente->fecha_nacimiento!='') {
				$fecha_nacimiento=date('d-m-Y',strtotime($model->paciente->fecha_nacimiento));
		}else{$fecha_nacimiento=null;}

		//Genero
		if ($model->paciente->genero==1) {
				$genero = "Masculino";
		}else{$genero = "Femenino";}
		//$elpaciente = Paciente::model()->findByPK($model->paciente_id);
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'paciente.n_identificacion',
				array('name'=> 'Genero', 'value'=>$genero),
				array('name'=> 'Fecha de Nacimiento', 'value'=>$fecha_nacimiento),
				'paciente.email',
				'paciente.telefono1',
				'paciente.telefono2',
				'paciente.celular',
			),
		)); ?>
	</div>
	<div class="span1"></div>
</div>
</html>