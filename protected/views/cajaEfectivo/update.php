<?php
/* @var $this CajaEfectivoController */
/* @var $model CajaEfectivo */

$this->breadcrumbs=array(
	'Caja Efectivos'=>array('index'),
	$model->personal_id=>array('view','id'=>$model->personal_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CajaEfectivo', 'url'=>array('index')),
	array('label'=>'Create CajaEfectivo', 'url'=>array('create')),
	array('label'=>'View CajaEfectivo', 'url'=>array('view', 'id'=>$model->personal_id)),
	array('label'=>'Manage CajaEfectivo', 'url'=>array('admin')),
);
?>

<h1>Update CajaEfectivo <?php echo $model->personal_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>