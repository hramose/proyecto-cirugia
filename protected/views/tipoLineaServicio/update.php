<?php
/* @var $this TipoLineaServicioController */
/* @var $model TipoLineaServicio */


$this->menu=array(
	array('label'=>'Listar Tipo de Linea de Servicio', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Linea de Servicio', 'url'=>array('create')),
	array('label'=>'Ver Tipo de Linea de Servicio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Tipo de Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipo de Linea de Servicio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>