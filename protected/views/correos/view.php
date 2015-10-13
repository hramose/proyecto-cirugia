<?php
/* @var $this CorreosController */
/* @var $model Correos */

$this->menu=array(
	//array('label'=>'List Correos', 'url'=>array('index')),
	//array('label'=>'Create Correos', 'url'=>array('create')),
	array('label'=>'Actualizar Correo', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Correos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Correos', 'url'=>array('admin')),
);
?>

<h1>Correos <?php echo $model->tipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tipo',
		'detalle',
		'pie',
		array('name'=>'Fecha de Actualizado', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$model->fecha_actualizado)),
		array('name'=>'Usuario que Actualizo', 'value'=>$model->usuario->nombreCompleto),
	),
)); ?>

<h3>El correo se vera de la siguiente manera:</h3>
<br>
<p><?php echo $model->detalle; ?></p>
<br>
<b>Paciente: </b>XXXX XXXXX XXXXXX XXXXXX
<br>
<b>Fecha de Cita: </b>XX/XX/XXXX
<br>
<b>Hora de Cita: </b>XX:XX xx
<br>
<b>Procedimiento:s </b>XXXXX XXXXXX XXXXX XXXXXXX
<br>
<br>
<p><?php echo $model->pie; ?></p>
