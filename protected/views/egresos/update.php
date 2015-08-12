<?php
/* @var $this EgresosController */
/* @var $model Egresos */

$this->menu=array(
	array('label'=>'Listar Egresos', 'url'=>array('index')),
	array('label'=>'Crear Egresos', 'url'=>array('create')),
	array('label'=>'Ver Egresos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Egresos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Egresos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>