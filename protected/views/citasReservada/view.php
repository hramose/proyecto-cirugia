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

$lafecha = strtotime ('+2 day', strtotime(date('Y-m-j')));
echo date ('Y-m-d', $lafecha); 

?>
