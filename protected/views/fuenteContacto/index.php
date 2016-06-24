<?php
/* @var $this FuenteContactoController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Fuente de Contacto','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Fuente de Contacto', 'url'=>array('admin')),
);
?>

<h1>Fuente de Contacto</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
