<?php
/* @var $this PagoCosmetologasController */
/* @var $model PagoCosmetologas */

$this->breadcrumbs=array(
	'Pago Cosmetologases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PagoCosmetologas', 'url'=>array('index')),
	array('label'=>'Create PagoCosmetologas', 'url'=>array('create')),
	array('label'=>'View PagoCosmetologas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PagoCosmetologas', 'url'=>array('admin')),
);
?>

<h1>Update PagoCosmetologas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>