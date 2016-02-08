<?php
/* @var $this EquiposController */
/* @var $model Equipos */

$this->menu=array(
	array('label'=>'Listar Equipos', 'url'=>array('index')),
	array('label'=>'Crear Equipo', 'url'=>array('create')),
	array('label'=>'Actualizar Equipo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Equipo', 'url'=>array('admin')),
);
?>

<h1>Equipos #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php 
		if($model->linea_servicio_id != Null)
		{	
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'nombre',
					array('name'=>'Linea de Servicio', 'value' => $model->lineaServicio->nombre),
					'numero',
					'Estado',
				),
			)); 
		}
		else
		{
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'nombre',
					array('name'=>'Linea de Servicio', 'value' => NULL),
					'numero',
					'Estado',
				),
			)); 	
		}
		?>		
	</div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'marca',
				'modelo',
				'serial',
				'ubicacion',
			),
		)); ?>
	</div>
	<div class="span1"></div>
</div>

<div class="row"><div class="span12"></div></div>

<div class="row">
	<div class="span12 text-center">
		<a href="#cambio" role="button" data-toggle="modal" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i> Cambiar estado de Equipo</a>
		<a href="#linea" role="button" data-toggle="modal" class="btn btn-success"> Vincular Linea de Servicio</a>
	</div>
</div>

<div class="row"><div class="span12"></div></div>

<?php 
	//Verificar si hay observaciones
	$nObservaciones = EquiposObservaciones::model()->count("equipo_id=".$model->id);
	$lasObservaciones = EquiposObservaciones::model()->findAll("equipo_id=".$model->id);
?>

<div class="row">
	<div class="span12">
		<?php if ($nObservaciones > 0)
		{
		?>
			<h3 class="text-center">Historial de Observaciones</h3>		
	</div>
</div>

<div class="row">
	<div class="span2"></div>
	<div class="span8">
	<table class="table">
		<tr>
			<th>Estado</th>
			<th>Observación</th>
			<th>Fecha</th>
			<th>Personal</th>
			<th></th>
		</tr>
		<?php 
			foreach($lasObservaciones as $las_observaciones){ 
				?>
			<tr>
				<td><?php echo $las_observaciones->estado; ?></td>
				<td><?php echo $las_observaciones->observacion; ?></td>
				<td><?php echo date('d-m-Y',strtotime($las_observaciones->fecha)); ?></td>
				<td><?php echo $las_observaciones->personal->nombreCompleto; ?></td>
				<td></td>
			</tr>
		<?php } ?>
	</table>
	<?php } ?>	
	</div>
	<div class="span2"></div>
</div>



<?php 
	//Determinar estado de Activo
	if ($model->Estado == "Activo") {
		$elEstado = "Inactivo";
	}
	else
	{
		$elEstado = "Activo";
	}

?>


<!-- ----------------------------------------------------------------------- -->
<!-- Modal Asignar Responsable -->
<div id="cambio" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Cambio de estado</h3>
  </div>
  <div class="modal-body">
  	<h4>Debe de justificar el cambio de estado del equipo a: <span class="text-info"><?php echo $elEstado; ?></span></h4>
	<?php 
	
	//echo CHtml::beginForm(CHtml::normalizeUrl(array('Responsables/create&id='.$model->id_correspondencia)), 'post');
	   

	//Yii::app()->clientScript->registerCoreScript('jquery');

	$equipoObservaciones = new EquiposObservaciones;

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'responsables-form',
	'action'=>Yii::app()->createUrl('//equiposObservaciones/create&idActivo='.$model->id),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($equipoObservaciones); ?>
	<div class="form"> 
	<div>
		<div class="span4">
			<?php echo $form->labelEx($equipoObservaciones,'observacion'); ?>	
			<?php echo $form->textArea($equipoObservaciones,'observacion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($equipoObservaciones,'observacion'); ?>	
		</div>
	</div>
  </div>
  	<div class="span10">
		<?php echo CHtml::submitButton($equipoObservaciones->isNewRecord ? 'Asignar' : 'Asignar', array('class'=>'btn btn-small btn-danger')); ?>
	</div>
  <?php $this->endWidget(); ?>
  </div>
  		
   <div class="modal-footer">
   		<?php //echo CHtml::submitButton('SI', array('submit'=>array('contratos/guardarContratos&idpresupuesto='.$model->id_correspondencia), 'class'=>'btn btn-large btn-primary')); ?>
	 	<!-- <button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>-->
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<!-- ----------------------------------------------------------------------- -->
<!-- Modal Asignar Responsable -->
<div id="linea" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Vincular Linea de Servicio</h3>
  </div>
  <div class="modal-body">
  	<h4>Seleccione la linea de servicio a vincular: </h4>
	<?php 
	
	//echo CHtml::beginForm(CHtml::normalizeUrl(array('Responsables/create&id='.$model->id_correspondencia)), 'post');
	   

	//Yii::app()->clientScript->registerCoreScript('jquery');

	$equipoObservaciones = new EquiposObservaciones;

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'responsables-form',
	'action'=>Yii::app()->createUrl('//equiposObservaciones/create&idActivo='.$model->id),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($equipoObservaciones); ?>
	<div class="form"> 
	<div>
		<div class="span4">
			<?php echo $form->labelEx($equipoObservaciones,'observacion'); ?>	
			<?php echo $form->textArea($equipoObservaciones,'observacion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($equipoObservaciones,'observacion'); ?>	
		</div>
	</div>
  </div>
  	<div class="span10">
		<?php echo CHtml::submitButton($equipoObservaciones->isNewRecord ? 'Asignar' : 'Asignar', array('class'=>'btn btn-small btn-danger')); ?>
	</div>
  <?php $this->endWidget(); ?>
  </div>
  		
   <div class="modal-footer">
   		<?php //echo CHtml::submitButton('SI', array('submit'=>array('contratos/guardarContratos&idpresupuesto='.$model->id_correspondencia), 'class'=>'btn btn-large btn-primary')); ?>
	 	<!-- <button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>-->
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>