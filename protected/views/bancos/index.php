<?php
/* @var $this BancosController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Banco','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Banco', 'url'=>array('admin')),
);
?>

<h1>Bancos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
