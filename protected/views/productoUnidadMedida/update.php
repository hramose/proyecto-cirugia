<?php
/* @var $this ProductoUnidadMedidaController */
/* @var $model ProductoUnidadMedida */

$this->menu=array(
	array('label'=>'Listar Unidad de Medida', 'url'=>array('index')),
	array('label'=>'Crear Unidad de Medida', 'url'=>array('create')),
	array('label'=>'Ver Unidad de Medida', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Unidad de Medida', 'url'=>array('admin')),
);
?>

<h1>Actuazliar Unidad de Medida <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>