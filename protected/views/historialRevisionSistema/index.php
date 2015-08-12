<?php
/* @var $this HistorialRevisionSistemaController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	//array('label'=>'Crear Revisión por Sistema', 'url'=>array('create')),
	//array('label'=>'Buscar Revisión por Sistema', 'url'=>array('admin')),
);
?>

<h1>Revisión por Sistemas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
