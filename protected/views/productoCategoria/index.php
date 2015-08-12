<?php
/* @var $this ProductoCategoriaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Categoría de Producto', 'url'=>array('create')),
	array('label'=>'Buscar Categoría de Producto', 'url'=>array('admin')),
);
?>

<h1>Categorias de Producto</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
