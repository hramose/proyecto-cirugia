<?php
/* @var $this BancosCuentasController */
/* @var $model BancosCuentas */

$this->menu=array(
	array('label'=>'Listar Cuenta de Banco', 'url'=>array('index')),
	array('label'=>'Crear Cuenta de Banco', 'url'=>array('create')),
	array('label'=>'Ver Cuenta de Banco', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Cuenta de Banco', 'url'=>array('admin')),
);
?>

<h1>Actualizar Cuenta de Banco <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>