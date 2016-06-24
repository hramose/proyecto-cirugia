<?php
/* @var $this EquiposController */
/* @var $model Equipos */


$this->menu=array(
	array('label'=>'Listar Equipos', 'url'=>array('index')),
	array('label'=>'Crear Equipo','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Equipo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Equipos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Equipos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>