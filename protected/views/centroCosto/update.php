<?php
/* @var $this CentroCostoController */
/* @var $model CentroCosto */


$this->menu=array(
	array('label'=>'Listar Centros de Costos', 'url'=>array('index')),
	array('label'=>'Crear Centro de Costo','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Centro de Costo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Centro de Costo', 'url'=>array('admin')),
);
?>

<h1>Actualizar Centro de Costo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>