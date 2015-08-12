<?php
/* @var $this PagoCosmetologasController */
/* @var $model PagoCosmetologas */

$this->breadcrumbs=array(
	'Pago Cosmetologases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PagoCosmetologas', 'url'=>array('index')),
	array('label'=>'Manage PagoCosmetologas', 'url'=>array('admin')),
);
?>

<h1>Create PagoCosmetologas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>