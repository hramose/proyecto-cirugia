<?php
/* @var $this TipoLineaServicioController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Tipo de Linea de Servicio', 'url'=>array('create')),
	array('label'=>'Buscar Tipo de Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Tipo de Linea de Servicios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
