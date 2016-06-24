<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->menu=array(
	array('label'=>'Listar Personal', 'url'=>array('index')),
	array('label'=>'Ingresar Personal','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Personal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Personal', 'url'=>array('admin')),
);
?>

<h1>Actualizar Personal <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>