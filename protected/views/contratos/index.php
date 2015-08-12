<?php
/* @var $this ContratosController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Buscar Contratos', 'url'=>array('admin')),
);
?>

<h1>Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
