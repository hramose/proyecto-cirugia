<?php
/* @var $this PresupuestoController */
/* @var $model Presupuesto */

$this->menu=array(
	//array('label'=>'Listar Presupuestos', 'url'=>array('index')),
	//array('label'=>'Crear Presupuesto', 'url'=>array('create')),
	array('label'=>'Ver Presupuesto', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Buscar Presupuesto', 'url'=>array('admin')),
);
?>

<h1>Actualizar Presupuesto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formupdate', array('model'=>$model)); ?>