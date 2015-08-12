<?php
/* @var $this LineaServicioController */
/* @var $model LineaServicio */


$this->menu=array(
	array('label'=>'Listar Linea de Servicios', 'url'=>array('index')),
	array('label'=>'Crear Linea de Servicio', 'url'=>array('create')),
	array('label'=>'Ver Linea de Servicio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Linea de Servicio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>