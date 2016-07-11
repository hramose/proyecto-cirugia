<?php
/* @var $this PacienteBaulController */
/* @var $model PacienteBaul */

	$textoMenu = "Ver Ficha de Paciente";
	$laRuta = "index.php?r=paciente/view&id=$model->paciente_id";
	$urlComplemento = "&idPaciente=$model->paciente_id";

$this->menu=array(
	array('label'=>"<i class='icon-circle-arrow-left'></i> ".$textoMenu, 'url'=>$laRuta),
);
?>

<h1>Baul de Paciente</h1>

<?php
$idPaciente = $model->paciente_id;
	$paciente = Paciente::model()->find("id=$idPaciente");
	$laFecha=date('d-m-Y',strtotime($model->fecha));
?>

<div class="row">
	<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					'edad',
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		<div class="span1"></div>
</div>

<div class="row">
	<div class="span1"></div>
	<div class="span10">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>$laFecha,''),
			),
		)); ?>

		<h3 class="text-center">Archivos</h3>
		<table class="table table-striped">
			<tr>
				<th>Archivos</th>
				<th></th>
			</tr>
		<?php $losArchivos = PacienteBaulDetalle::model()->findAll("paciente_baul_id = $model->id"); ?>
		<?php 
			foreach ($losArchivos as $los_archivos) 
			{
				?>
				<tr>
					<td>
						<center>
							<?php echo $los_archivos->archivo ?>
						</center>
					</td>
					<td>
					<a href=<?php echo yii::app()->baseUrl."/adjuntos/".$los_archivos->archivo ; ?> target="_blank">[Ver]</a>
					</td>
				</tr>

				<?php
			}
		?>
		</table>
	</div>
	<div class="span1"></div>
</div>
