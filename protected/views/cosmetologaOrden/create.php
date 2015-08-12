<?php
/* @var $this CosmetologaOrdenController */
/* @var $model CosmetologaOrden */

$this->breadcrumbs=array(
	'Cosmetologa Ordens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CosmetologaOrden', 'url'=>array('index')),
	array('label'=>'Manage CosmetologaOrden', 'url'=>array('admin')),
);
?>

<h1>Create CosmetologaOrden</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>