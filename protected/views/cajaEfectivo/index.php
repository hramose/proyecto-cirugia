<?php
/* @var $this CajaEfectivoController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	//array('label'=>'Create CajaEfectivo', 'url'=>array('create')),
	array('label'=>'Buscar Saldos', 'url'=>array('admin')),
);
?>

<h1>Saldos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
