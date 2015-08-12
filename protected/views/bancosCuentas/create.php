<?php
/* @var $this BancosCuentasController */
/* @var $model BancosCuentas */

$this->menu=array(
	array('label'=>'Listar Cuentas de Bancos', 'url'=>array('index')),
	array('label'=>'Buscar Cuenta de Banco', 'url'=>array('admin')),
);
?>

<h1>Crear Cuenta de Banco</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>