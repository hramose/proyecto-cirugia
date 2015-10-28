<?php
/* @var $this ConfiguracionesController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(

);
?>

<h1>Super Usuario</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
