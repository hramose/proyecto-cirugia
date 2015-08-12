<?php
/* @var $this HistorialTablaMedidasController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	// array('label'=>'Crear Tabla de Medidas', 'url'=>array('create')),
	// array('label'=>'Buscar Tabla de Medidas', 'url'=>array('admin')),
);
?>

<h1>Tabla de Medidas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
