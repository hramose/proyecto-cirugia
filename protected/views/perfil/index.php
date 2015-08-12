<?php
/* @var $this PerfilController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Perfil', 'url'=>array('create')),
	array('label'=>'Buscar Perfil', 'url'=>array('admin')),
);
?>

<h1>Perfiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
