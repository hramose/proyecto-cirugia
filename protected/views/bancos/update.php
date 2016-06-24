<?php
/* @var $this BancosController */
/* @var $model Bancos */


$this->menu=array(
	array('label'=>'Listar Bancos', 'url'=>array('index')),
	array('label'=>'Crear Banco','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Banco', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Banco', 'url'=>array('admin')),
);
?>

<h1>Actualizar Banco <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>