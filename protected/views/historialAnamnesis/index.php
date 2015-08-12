<?php
/* @var $this HistorialAnamnesisController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	//array('label'=>'Create HistorialAnamnesis', 'url'=>array('create')),
	array('label'=>'Buscar Anamnesis', 'url'=>array('admin')),
);
?>

<h1>Anamnesis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
