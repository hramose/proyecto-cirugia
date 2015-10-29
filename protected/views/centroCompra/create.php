<?php
/* @var $this CentroCompraController */
/* @var $model CentroCompra */

$this->menu=array(
	array('label'=>'Buscar Centro de Compra', 'url'=>array('admin')),
);
?>

<h1>Crear Centro de Compra</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>