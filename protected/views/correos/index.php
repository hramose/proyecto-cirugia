<?php
/* @var $this CorreosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Correoses',
);

$this->menu=array(
	array('label'=>'Create Correos', 'url'=>array('create')),
	array('label'=>'Manage Correos', 'url'=>array('admin')),
);
?>

<h1>Correoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
