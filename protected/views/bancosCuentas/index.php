<?php
/* @var $this BancosCuentasController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Cuentas de Banco', 'url'=>array('create')),
	array('label'=>'Buscar Cuentas de Banco', 'url'=>array('admin')),
);
?>

<h1>Cuentas de Banco</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
