<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */


$this->menu=array(
	array('label'=>'Listar Formulaciones', 'url'=>array('index')),
	array('label'=>'Crear Formulación','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Formulación', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Formulación', 'url'=>array('admin')),
);
?>

<h1>Actualizar Formulación <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>