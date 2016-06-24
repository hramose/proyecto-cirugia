<?php
/* @var $this CentroCompraController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Centro de Compra','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Centro de Compra', 'url'=>array('admin')),
);
?>

<h1>Centro Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
