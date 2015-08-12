<?php
/* @var $this BancosController */
/* @var $model Bancos */


$this->menu=array(
	array('label'=>'Listar Bancos', 'url'=>array('index')),
	array('label'=>'Buscar Banco', 'url'=>array('admin')),
);
?>

<h1>Crear Banco</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>