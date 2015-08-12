<?php
/* @var $this RelacionHojaGastosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Relacion Hoja Gastoses',
);

$this->menu=array(
	array('label'=>'Create RelacionHojaGastos', 'url'=>array('create')),
	array('label'=>'Manage RelacionHojaGastos', 'url'=>array('admin')),
);
?>

<h1>Relacion Hoja Gastoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
