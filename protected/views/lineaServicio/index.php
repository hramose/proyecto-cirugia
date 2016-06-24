<?php
/* @var $this LineaServicioController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Linea de Servicio', 'visible'=>Yii::app()->user->perfil <> 1,'url'=>array('create')),
	array('label'=>'Buscar Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Linea de Servicio</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
