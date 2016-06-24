<?php
/* @var $this PersonalController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Ingresar Personal', 'visible'=>Yii::app()->user->perfil <> 1,'url'=>array('create')),
	array('label'=>'Buscar Personal', 'url'=>array('admin')),
);
?>

<h1>Personal</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
