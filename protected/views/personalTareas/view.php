<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */

$this->menu=array(
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Actualizar Tarea', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Tarea', 'url'=>array('admin')),
);
?>

<h1>Tarea #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto),
				'tarea',
				array('name'=>'fecha_cumplir', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy", $model->fecha_cumplir)),
				'estado',
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss", $model->fecha)),
				array('name'=>'usuario_id', 'value'=>$model->usuario->nombreCompleto),
			),
		)); 
		if ($model->comentarios_responsable) {
			echo "<br><h4 class='text-center'>Comentarios de Responsable</h4>";
			echo $model->comentarios_responsable;	
		}
		
		?>
	</div>
	<div class="span6 text-center">
		<h3 class="text-center">Opciones</h3>
		<?php if ($model->personal_id == Yii::app()->user->usuarioId and $model->estado != "Completada"){?>
			<a href="#comentario" role="button" class="btn btn-small btn-primary" data-toggle="modal"><i class="icon-comment icon-white"></i> Agregar Comentario</a>
			<a href="#cierre" data-toggle="modal" class="btn btn-small btn-warning"><i class="icon-thumbs-up icon-white"></i> Completar Tarea</a>	
		<?php }else{ 
			if ($model->estado == "Completada") 
			{
				?>
				<p class="text-center"><i>Usted no puede modificar esta tarea. Ya esta completada</i></p>
			<?php
			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'comentario_cierre',
				array('name'=>'fecha_cierre', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss", $model->fecha_cierre)),
			),
		)); 
			}else{
			?>
			<p class="text-center"><i>Usted no puede modificar esta tarea</i></p>
		<?php }} ?>
		
	</div>
</div>


<div id="comentario" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Agregar comentarios a tarea</h3>
  </div>
  <div class="modal-body">
 	<p>Complete el siguiente formulario</p>
 	
	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'cancelar-form',
		'action'=>Yii::app()->baseUrl.'/index.php?r=personalTareas/comentario&id='.$model->id,
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		)); ?>
	 	<?php 
	 		$elcomentario = new PersonalTareas;
	 	?>
				<div class = 'span10'>
					<?php echo $form->labelEx($elcomentario,'comentarios_responsable'); ?>
					<?php echo $form->textArea($elcomentario,'comentarios_responsable',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($elcomentario,'comentarios_responsable'); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($elcomentario->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
  </div>
  
   <div class="modal-footer">
	<?php 
   		 	echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<div id="cierre" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Completar Tarea</h3>
  </div>
  <div class="modal-body">
 	<p>Complete el siguiente formulario</p>
 	
	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'cancelar-form',
		'action'=>Yii::app()->baseUrl.'/index.php?r=personalTareas/cierre&id='.$model->id,
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		)); ?>
	 	<?php 
	 		$elcomentario = new PersonalTareas;
	 	?>
				<div class = 'span10'>
					<?php echo $form->labelEx($elcomentario,'comentario_cierre'); ?>
					<?php echo $form->textArea($elcomentario,'comentario_cierre',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($elcomentario,'comentario_cierre'); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($elcomentario->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
  </div>
  
   <div class="modal-footer">
	<?php 
   		 	echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>