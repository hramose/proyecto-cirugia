<?php
/* @var $this ProductoCategoriaController */
/* @var $model ProductoCategoria */

$this->menu=array(
	array('label'=>'Listar Categoría de Producto', 'url'=>array('index')),
	array('label'=>'Crear Categoría de Producto', 'url'=>array('create')),
	array('label'=>'Actualizar Categoría de Producto', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Categoría de Producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Categoría de Producto', 'url'=>array('admin')),
);
?>

<h1>Categoría de Producto #<?php echo $model->id; ?></h1>

<div class="span1"></div>
<div class="span10">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'categoria',
		),
	)); ?>	
</div>
<div class="span1"></div>

