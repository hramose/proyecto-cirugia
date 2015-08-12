<?php
/* @var $this InventarioPersonalController */
/* @var $model InventarioPersonal */

$this->menu=array(
	array('label'=>'Listar Inventario Personal', 'url'=>array('index')),
	array('label'=>'Crear Inventario Personal', 'url'=>array('create')),
	array('label'=>'Ver Inventario Personal', 'url'=>array('view', 'id'=>$model->personal_id)),
	array('label'=>'Buscar Inventario Personal', 'url'=>array('admin')),
);
?>

<h1>Actualizar Inventario Personal <?php echo $model->personal_id; ?></h1>

<?php $this->renderPartial('_formupdate', array('model'=>$model)); ?>