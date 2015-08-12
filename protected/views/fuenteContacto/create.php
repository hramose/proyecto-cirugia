<?php
/* @var $this FuenteContactoController */
/* @var $model FuenteContacto */


$this->menu=array(
	array('label'=>'Listar Fuentes de Contacto', 'url'=>array('index')),
	array('label'=>'Buscar Fuente de Contacto', 'url'=>array('admin')),
);
?>

<h1>Crear Fuente de Contacto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>