<?php
/* @var $this ActivoInventarioController */
/* @var $model ActivoInventario */

$this->menu=array(
	array('label'=>'Listar Activos', 'url'=>array('index')),
	array('label'=>'Crear Activo', 'url'=>array('create')),
	array('label'=>'Actualizar Activo', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Activo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Activos', 'url'=>array('admin')),
);
?>

<?php
//------------ add the CJuiDialog widget -----------------
if (!empty($asDialog)):
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
        'id'=>'dlg-address-view-'. $model->id,
        'options'=>array(
            'title'=>'Activo #'. $model->id,
            'autoOpen'=>true,
            'modal'=>false,
            'width'=>550,
            'height'=>400,
        ),
 ));
 
else:
//-------- default code starts here ------------------
?>
<h1>Activo #<?php echo $model->id; ?></h1>

<?php endif; ?>
<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'activoTipo.tipo',
				'nombre',
				'marca',
				'modelo',
			),
		)); ?>
	</div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'serial',
				'caracteristicas',
				'ubicacion',
				'estado',
			),
		)); ?>
	</div>
	<div class="span1"></div>
</div>

<div class="row"><div class="span12"></div></div>



<?php 
if (!empty($asDialog))
{
	?>
	<div style="display: none">
	<?php
}
else
{
	?>
		<div>
	<?php
}

?>

<div class="row">
	<div class="span12 text-center">
		<a href="#cambio" role="button" data-toggle="modal" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i> Cambiar estado de Activo</a>
	</div>
</div>

<div class="row"><div class="span12"></div></div>

<?php 
	//Verificar si hay observaciones
	$nObservaciones = ActivoObservaciones::model()->count("activo_inventario_id=".$model->id);
	$lasObservaciones = ActivoObservaciones::model()->findAll("activo_inventario_id=".$model->id);
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
	if ($model->estado == "Activo") {
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
  	<h4>Debe de justificar el cambio de estado del activo a: <span class="text-info"><?php echo $elEstado; ?></span></h4>
	<?php 
	
	//echo CHtml::beginForm(CHtml::normalizeUrl(array('Responsables/create&id='.$model->id_correspondencia)), 'post');
	   

	//Yii::app()->clientScript->registerCoreScript('jquery');

	$activosObservaciones = new activoObservaciones;

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'responsables-form',
	'action'=>Yii::app()->createUrl('//activoObservaciones/create&idActivo='.$model->id),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($activosObservaciones); ?>
	<div class="form"> 
	<div>
		<div class="span4">
			<?php echo $form->labelEx($activosObservaciones,'observacion'); ?>	
			<?php echo $form->textArea($activosObservaciones,'observacion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($activosObservaciones,'observacion'); ?>	
		</div>
	</div>
  </div>
  	<div class="span10">
		<?php echo CHtml::submitButton($activosObservaciones->isNewRecord ? 'Asignar' : 'Asignar', array('class'=>'btn btn-small btn-danger')); ?>
	</div>
  <?php $this->endWidget(); ?>
  </div>
  		
   <div class="modal-footer">
   		<?php //echo CHtml::submitButton('SI', array('submit'=>array('contratos/guardarContratos&idpresupuesto='.$model->id_correspondencia), 'class'=>'btn btn-large btn-primary')); ?>
	 	<!-- <button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>-->
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
<div>
<?php 
  //----------------------- close the CJuiDialog widget ------------
  if (!empty($asDialog)) $this->endWidget();
?>
