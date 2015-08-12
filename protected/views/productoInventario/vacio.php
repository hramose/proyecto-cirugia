<?php
/* @var $this VentasController */
/* @var $model Ventas */

$this->menu=array(
	//array('label'=>'Listar Productos', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Listar Todos', 'url'=>"index.php?r=productoInventario/admin&tipo=0"),
	array('label'=>'Listar Productos', 'url'=>"index.php?r=productoInventario/admin&tipo=1"),
	array('label'=>'Listar Insumos', 'url'=>"index.php?r=productoInventario/admin&tipo=2"),
	array('label'=>'Listar Consumibles', 'url'=>"index.php?r=productoInventario/admin&tipo=3"),
	array('label'=>'Listar Inactivos', 'url'=>"index.php?r=productoInventario/admin&tipo=4"),
);

?>
<?php 
?>
<h1>No hay Productos</h1>
