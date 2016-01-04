<?php
	/* @var $this CitasReservadaController */
	/* @var $model CitasReservada */

	$this->menu=array(
		array('label'=>'Crear Citas Reservada', 'url'=>array('create')),
		array('label'=>'Actualizar Citas Reservada', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Buscar Citas Reservada', 'url'=>array('admin')),
	);
?>

<h1>Cita Reservada #<?php echo $model->id; ?></h1>

<div class="rows">
	<div class="span6">
		<?php 

	if ($model->fecha_fin == "0000-00-00") 
	{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Personal', 'value'=>$model->personal->nombreCompleto, ''),
				array('name'=>'Fecha', 'value'=>date('d-m-Y',strtotime($model->fecha_inicio)),''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$model->horaFin->hora ,''),
				'motivo',
				'observacion',
				array('name'=>'Creado por', 'value'=>$model->usuario->nombreCompleto, ''),
				array('name'=>'Fecha de Registro', 'value'=>date('d-m-Y h:m:s',strtotime($model->fecha_creado)),''),
				'estado',
			),
		)); 	
	}



	if ($model->fecha_fin != "0000-00-00") 
	{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Personal', 'value'=>$model->personal->nombreCompleto, ''),
				array('name'=>'Fecha de Inicio', 'value'=>date('d-m-Y',strtotime($model->fecha_inicio)),''),
				array('name'=>'Fecha de Fin', 'value'=>date('d-m-Y',strtotime($model->fecha_fin)),''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$model->horaFin->hora ,''),
				'motivo',
				'observacion',
				array('name'=>'Creado por', 'value'=>$model->usuario->nombreCompleto, ''),
				array('name'=>'Fecha de Registro', 'value'=>date('d-m-Y h:m:s',strtotime($model->fecha_creado)),''),
				'estado',
			),
		));	
	}

	//echo date('Y-m-d') ;

	// $lafecha = strtotime ('+2 day', strtotime(date('Y-m-j')));
	// //echo date ('Y-m-d', $lafecha); 

	// //Para calcular el numero de dias
	// $datetime1 = date_create('2009-10-11');
	// $datetime2 = date_create('2009-10-13');
	// $interval = date_diff($datetime1, $datetime2);
	// $ndias = $interval->format('%a')  + 1;
	// echo $ndias;


?>		
	</div>
	<div class="span5 text-center">
		<h2 class="text-center">Opciones</h2>
		<a href="#" class="btn btn-primary">Desbloquear Agenda</a>
		<a href="index.php?r=citas/calendario&idpersonal=<?php echo $model->personal->id_perfil.'&fecha='.$model->fecha_inicio ?>" role="button" class="btn btn-warning" data-toggle="modal"><i class="icon-zoom-in icon-white"></i> Ver Agenda</a>
	</div>
</div>
