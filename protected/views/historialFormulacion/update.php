<?php
/* @var $this HistorialFormulacionController */
/* @var $model HistorialFormulacion */

$this->menu=array(
	// array('label'=>'Listar Formulaciones', 'url'=>array('index')),
	// array('label'=>'Crear Formulación', 'url'=>array('create')),
	// array('label'=>'Ver Formulación', 'url'=>array('view', 'id'=>$model->id)),
	// array('label'=>'Buscar Formulación', 'url'=>array('admin')),
);
?>

<h1>Actualizar Formulación <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formupdate', array('model'=>$model)); ?>