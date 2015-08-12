<?php
/* @var $this EgresosController */
/* @var $model Egresos */

$this->menu=array(
	//array('label'=>'Listar Egresos', 'url'=>array('index')),
	array('label'=>'Buscar Egresos', 'url'=>array('admin')),
);
?>
<?php 
	//Calcular proximo numero de compra
	$proxima = new Egresos;
	$criteria=new CDbCriteria;
	$criteria->select='max(id) AS id';
	$row = $proxima->model()->find($criteria);
	$elid = $row['id'] +1;
?>

<h1>Crear Egreso #<?php echo $elid; ?></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>