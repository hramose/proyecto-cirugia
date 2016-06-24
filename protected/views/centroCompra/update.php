<?php
/* @var $this CentroCompraController */
/* @var $model CentroCompra */

$this->menu=array(
	array('label'=>'Crear Centro de Compra','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Centro de Compra', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Centro de Compra', 'url'=>array('admin')),
);
?>

<h1>Actualizar Centro de Compra <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>