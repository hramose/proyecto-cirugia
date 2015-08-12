<?php
/* @var $this CosmetologaOrdenController */
/* @var $model CosmetologaOrden */

$this->menu=array(
	array('label'=>'List CosmetologaOrden', 'url'=>array('index')),
	array('label'=>'Create CosmetologaOrden', 'url'=>array('create')),
	array('label'=>'View CosmetologaOrden', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CosmetologaOrden', 'url'=>array('admin')),
);
?>

<h1>Update CosmetologaOrden <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>