<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */

$this->menu=array(
	//array('label'=>'Listar Compras de Productos', 'url'=>array('index')),
	array('label'=>'Buscar Compra', 'url'=>array('admin')),
);
?>

<?php 
	//Calcular proximo numero de compra
	$proxima = new ProductoCompras;
	$criteria=new CDbCriteria;
	$criteria->select='max(id) AS id';
	$row = $proxima->model()->find($criteria);
	$elid = $row['id']+1;
?>

<h1>Crear Compra #<?php echo $elid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>