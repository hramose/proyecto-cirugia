<?php
/* @var $this SeguimientoTemaController */
/* @var $model SeguimientoTema */

$this->menu=array(
	array('label'=>'Listar Temas de Seguimiento', 'url'=>array('index')),
	array('label'=>'Crear Tema de Seguimiento', 'url'=>array('create')),
	array('label'=>'Ver Tema de Seguimiento', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Tema de Seguimiento', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tema de Seguimiento <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>