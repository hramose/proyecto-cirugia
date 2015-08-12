<?php
/* @var $this VentasController */
/* @var $model Ventas */

$this->menu=array(
	//array('label'=>'Listar Ventas', 'url'=>array('index')),
	array('label'=>'Buscar Ventas', 'url'=>array('admin')),
);
?>



<?php 
	//Calcular proximo numero de compra
	$proxima = new Ventas;
	$criteria=new CDbCriteria;
	$criteria->select='max(id) AS id';
	$row = $proxima->model()->find($criteria);
	$elid = $row['id'] +1;
?>
<h1>Crear Venta #<?php echo $elid; ?></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>