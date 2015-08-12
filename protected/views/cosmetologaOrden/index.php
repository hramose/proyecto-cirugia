<?php
/* @var $this CosmetologaOrdenController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Buscar Pagos a Cosmetologas', 'url'=>array('admin')),
);
?>

<h1>Pagos a Cosmetologas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
