<?php
/* @var $this DiagnosticosController */
/* @var $model Diagnosticos */

$this->menu=array(
	array('label'=>'Listar Diagnosticos', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Diagnostico', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Diagnostico', 'url'=>array('admin')),
);
?>

<h1>Actualizar Diagnostico <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>