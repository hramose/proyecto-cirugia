<?php
/* @var $this PacienteFotografiasController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Agregar Fotografias de Pacientes', 'url'=>array('create')),
	array('label'=>'Buscar Fotografias de Pacientes', 'url'=>array('admin')),
);
?>

<h1>Fotografias de Pacientes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
