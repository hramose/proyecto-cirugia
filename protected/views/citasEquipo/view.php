<?php
/* @var $this CitasEquipoController */
/* @var $model CitasEquipo */

$this->menu=array(
	// array('label'=>'List CitasEquipo', 'url'=>array('index')),
	// array('label'=>'Create CitasEquipo', 'url'=>array('create')),
	// array('label'=>'Update CitasEquipo', 'url'=>array('update', 'id'=>$model->cita_id)),
	// array('label'=>'Delete CitasEquipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cita_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Agenda de Equipos', 'url'=>array('admin')),
);

if ($model->fecha!='') {
				$fecha_cita=date('d-m-Y',strtotime($model->fecha));
		}else{$fecha_cita=null;}
?>

<h1>Equipo para cita #<?php echo $model->cita_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fecha',
		array('name'=>'Fecha de Cita', 'value'=>$fecha_cita,''),
		array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
		array('name'=>'Hora de Fin', 'value'=>$model->horaFinMostrar->hora ,''),
		array('name'=>'Equipo Asignado', 'value'=>$model->equipo->nombre . ' - ' . $model->equipo->numero ,''),
		array('name'=>'Linea de Servicio', 'value'=>$model->lineaServicio->nombre ,''),
	),
)); ?>
