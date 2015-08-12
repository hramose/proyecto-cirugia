<?php
/* @var $this SeguimientoTemaController */
/* @var $model SeguimientoTema */


$this->menu=array(
	array('label'=>'Listar Temas de Seguimiento', 'url'=>array('index')),
	array('label'=>'Buscar Tema de Seguimiento', 'url'=>array('admin')),
);
?>

<h1>Crear Tema de Seguimiento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>