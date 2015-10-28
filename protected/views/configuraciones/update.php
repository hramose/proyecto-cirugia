<?php
/* @var $this ConfiguracionesController */
/* @var $model Configuraciones */

$this->menu=array(
	array('label'=>'Ver', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Actualizar Super Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>