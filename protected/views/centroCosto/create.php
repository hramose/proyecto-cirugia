<?php
/* @var $this CentroCostoController */
/* @var $model CentroCosto */


$this->menu=array(
	array('label'=>'Listar Centros de Costo', 'url'=>array('index')),
	array('label'=>'Buscar Centro de Costo', 'url'=>array('admin')),
);
?>

<h1>Crear Centro de Costo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>