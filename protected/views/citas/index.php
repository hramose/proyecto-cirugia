<?php
/* @var $this CitasController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Buscar Citas', 'url'=>array('admin')),
);
?>

<h1>Citas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
