<?php
/* @var $this SeguimientoComercialController */
/* @var $model SeguimientoComercial */

$this->menu=array(
	//array('label'=>'Buscar Seguimiento Comercial', 'url'=>array('admin')),
	//array('label'=>'Listar Seguimiento Comercial', 'url'=>array('index')),
	//array('label'=>'Crear Seguimiento Comercial', 'url'=>array('create')),
	//array('label'=>'Actualizar Seguimiento Comercial', 'url'=>array('update', 'id'=>$model->id)),

);
?>

<?php 
	//Titulo
	switch ($model->estado) {
		case 'Abierto':
			$tituloPrincipal = "Abierto";
			break;
		case 'Cerrado':
			$tituloPrincipal = "Cerrado";
			break;
		case 'Vencido':
			$tituloPrincipal = "Vencido";
			break;
	}
?>

<h1>Seguimiento Comercial <?php echo $tituloPrincipal." #".$model->id; ?></h1>

<div class='row'>
	<div class='span1'></div>
	<div class='span5'>
		<br>
		<?php 
			if ($model->fecha_registro!='') {
					$fecha_registro=date('d-m-Y',strtotime($model->fecha_registro));
			}else{$fecha_registro=null;}

			if ($model->fecha_accion!='') {
					$fecha_accion=date('d-m-Y',strtotime($model->fecha_accion));
			}else{$fecha_accion=null;}

			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'paciente.nombreCompleto',
				array('name'=>'Fecha de Accion', 'value'=>$fecha_accion,''),
				array('name'=>'Tema', 'value'=>$model->tema->nombre),
				'observaciones',
				'estado',
				array('name'=>'Responsable de Seguimiento', 'value'=>$model->idPersonal->nombreCompleto),
			),
		)); ?>
	</div>

	<div class='span5'>
		<h4 class="text-center">Datos del Paciente</h4>
		<?php 
			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'paciente.n_identificacion',
				'paciente.telefono1',
				'paciente.telefono2',
				'paciente.celular',
				'paciente.email',
				'paciente.direccion',
			),
		)); ?>
	</div>
	<div class='span1'></div>
</div>

<div class="row">
	<div class="span4"></div>
		<div class="span4 text-center">
			<?php if ($model->estado == "Cerrado") {
					$this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'comentario_estado',
					),
				)); 
			} ?>
		</div>
	<div class="span4"></div>
</div>

<div class="row">
	<div class="span12"></div>
</div>


<?php 
$laInsidencia = SeguimientoComercialDetalle::model()->findAll("seguimiento_comercial_id = $model->id");
if (count($laInsidencia)>0) {
	
?>
<h3 class="text-center">Insidencias de Seguimiento Comercial</h3>
	<div class="row">
		<div class="span1"></div>
		<div class="span10">
			<table class="table table-striped">
					<tr>
						<th size="15%">Registrado</th>
						<th size="50%">Insidencia</th>
						<th size="15%">Fecha de Acción</th>
						<th size="20%">Responsable</th>
					</tr>
				<?php 
					foreach ($laInsidencia as $la_insidencia) 
					{
				?>
					<tr>
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$la_insidencia->fecha_registro); ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $la_insidencia->seguimiento; ?>"><?php echo $la_insidencia->seguimiento; ?></a></td>							
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$la_insidencia->fecha_seguimiento); ?></td>
						<td><?php echo $la_insidencia->responsable->nombreCompleto; ?></td>
					</tr>
				<?php
					}
				?>					
				</table>
		</div>
		<div class="span1"></div>
	</div>

	
<?php } ?>
<div class="text-center">
<a class="btn btn-success" href='index.php?r=paciente/view&id=<?php echo $model->paciente_id;?>'><i class="icon-search icon-white"></i> Ficha de Paciente</a>
<?php 
	switch ($model->estado) {
		case 'Abierto':
			echo "<a href='index.php?r=seguimientoComercial/admin&filtro=1' class='btn btn-info'><i class='icon-arrow-left icon-white'></i> Regresar a Seguimientos Abiertos</a>";
			break;
		
		case 'Cerrado':
			echo "<a href='index.php?r=seguimientoComercial/admin&filtro=2' class='btn btn-info'><i class='icon-arrow-left icon-white'></i> Regresar a Seguimientos Cerrados</a>";
			break;
		
		case 'Vencido':
			echo "<a href='index.php?r=seguimientoComercial/admin&filtro=3' class='btn btn-info'><i class='icon-arrow-left icon-white'></i> Regresar a Seguimientos Vencidos</a>";
			break;
		
		
	}
?>
</div>

<?php if ($model->estado == "Abierto" or $model->estado == "Vencido") {?>
<div class="row">
	<div class = "span12">
		<h3 class="text-center">Opciones</h3>
		<div class="hero-unit">
			<div class="text-center">
				<a href="#cerrar" role="button" class="btn btn-danger" data-toggle="modal"><i class="icon-folder-close icon-white"></i> Cerrar Seguimiento Comercial</a>
				<a href="#insidencia" role="button" class="btn btn-warning" data-toggle="modal"><i class="icon-th-list icon-white"></i> Insidencia Seguimiento Comercial</a>
			</div>
		</div>
	</div>
</div>
<?php } ?>


<?php 
$elSeguimiento = SeguimientoComercial::model()->findAll("paciente_id = $model->paciente_id and id != $model->id");
if (count($elSeguimiento)>0) {
	
?>
<h3 class="text-center">Historial de Seguimientos</h3>
	<div class="row">
		<div class="span1"></div>
		<div class="span10">
			<table class="table table-striped">
					<tr>
						<th>Programada</th>
						<th>Estado</th>
						<th>Tema</th>
						<th>Observaciones</th>
						<th>Responsable</th>
						<th><!-- Atendida --></th>

					</tr>
				<?php 
					foreach ($elSeguimiento as $el_seguimiento) 
					{
				?>
					<tr>
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$el_seguimiento->fecha_accion); ?></td>
						<td><?php echo $el_seguimiento->estado; ?></td>
						<td><?php echo $el_seguimiento->tema->nombre; ?></td>
						<td><?php echo $el_seguimiento->observaciones; ?></td>
						<td><?php echo $el_seguimiento->idPersonal->nombreCompleto; ?></td>
						<td><?php 
							//if ($el_seguimiento->fecha_atencion != Yii::app()->dateformatter->format("dd-MM-yyyy",date("Y-m-d"))) {
								//echo Yii::app()->dateformatter->format("dd-MM-yyyy",$el_seguimiento->fecha_atencion); 
							//}
						?>
						<!-- Para Ver -->
						<small><a href='index.php?r=seguimientoComercial/view&id=<?php echo $el_seguimiento->id;?>'>[Ver]</a></small>
						</td>
					</tr>
				<?php
					}
				?>					
				</table>
		</div>
		<div class="span1"></div>
	</div>

<?php } ?>
</div>






<!-- Modal Cerrar Seguimiento Comercial -->
<div id="cerrar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Se dispone a cerrar el Seguimiento Comercial</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	

	
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'seguimiento-comercial-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
			
				<div class ="span5">
					<?php echo $form->labelEx($model,'comentario_estado'); ?>
					<?php echo $form->textArea($model,'comentario_estado',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($model,'comentario_estado'); ?>
					<p>Desea cerrar el Seguimiento Comercial?</p>
					<?php echo CHtml::submitButton('SI', array('submit'=>array('seguimientoComercial/cerrar&idSeguimiento='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
					<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>
				</div>
			
		<?php $this->endWidget(); ?>
		
  </div>
  
   <div class="modal-footer">

  </div>
</div>


<!-- SEGUIMIENTOS COMERCIALES -->
<!-- Insidencia -->
<div id="insidencia" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Insidencia Seguimiento Comercial</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	
 	<?php echo CHtml::beginForm(CHtml::normalizeUrl(array('seguimientoComercial/view&id='.$model->id)), 'post'); ?> 
		<div class='formulario'>    
		
			<div class="form"> 
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'seguimiento-comercial-detalle-form',
				'enableAjaxValidation'=>false,
			)); ?>

				<?php 
					$tabla_seguimiento = new SeguimientoComercialDetalle;
					echo $form->errorSummary($tabla_seguimiento);
					$lafecha = date("d-m-Y");
				?>
				
				<div>
					<?php echo $form->labelEx($tabla_seguimiento,'fecha_seguimiento'); ?>
					<div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
					<?php 			
								//$lafecha = '';
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'name'=>'fecha_seguimiento',
							'language'=>'es',
							'model' => $tabla_seguimiento,
							'attribute' => 'fecha_seguimiento',
							'value'=> $lafecha,						
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'language' => 'es',
								'dateFormat' => 'dd-mm-yy',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;width:80px;'
							),
						));
					?>
					</div>
					<?php echo $form->error($tabla_seguimiento,'fecha_seguimiento'); ?>
				</div>

				<div>
					<?php echo $form->labelEx($tabla_seguimiento,'seguimiento'); ?>
					<?php echo $form->textArea($tabla_seguimiento,'seguimiento',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($tabla_seguimiento,'seguimiento'); ?>
				</div>
				
				<div>
					<div class="span12">
						<?php echo $form->labelEx($tabla_seguimiento,'responsable_id'); ?>
						<?php echo $form->dropDownList($tabla_seguimiento, 'responsable_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' order by 'nombreCompleto'"),'id','nombreCompleto'), array('class'=>'input-xlarge'));?>
						<?php echo $form->error($tabla_seguimiento,'responsable_id'); ?>
					</div>				
				</div>				

				<?php $this->endWidget(); ?>

  				<div class='acciones'> 

					<?php echo CHtml::submitButton('Guardar', array("document.getElementById('DetalleIncidencia').action = '" . CHtml::normalizeUrl(array('ventanasController/agregarDetalleIncidencia')) . "'" , 'class'=>'btn btn-danger')); ?>

			 	</div>    
			   
			<!-- Cierra el formulario -->  
			<?php echo CHtml::endForm(); ?>
		</div>

  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
