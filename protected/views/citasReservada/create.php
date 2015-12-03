<?php
/* @var $this CitasReservadaController */
/* @var $model CitasReservada */

$this->menu=array(
	//array('label'=>'List CitasReservada', 'url'=>array('index')),
	array('label'=>'Buscar Reservas', 'url'=>array('admin')),
);
?>

<h1>Crear Reserva de Citas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>