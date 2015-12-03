<?php
/* @var $this CitasReservadaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Citas Reservadas',
);

$this->menu=array(
	array('label'=>'Cerar Reserva', 'url'=>array('create')),
	array('label'=>'Buscar Reserva', 'url'=>array('admin')),
);
?>

<h1>Citas Reservadas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
