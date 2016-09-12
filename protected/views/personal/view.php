<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->menu=array(
	//array('label'=>'Listar Personal', 'url'=>array('index')),
	array('label'=>'Ingresar Personal', 'visible'=>Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 6 or Yii::app()->user->perfil == 3, 'url'=>array('create')),
	array('label'=>'Actualizar Personal', 'visible'=>Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 6 or Yii::app()->user->perfil == 3, 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Personal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Personal', 'url'=>array('admin')),
);

if ($model->fecha_nacimiento!='') {
		$fecha_nacimiento=date('d-m-Y',strtotime($model->fecha_nacimiento));
}

?>

<h1>Personal #<?php echo $model->id; ?></h1>

<div class="row-fluid">
	<div class="span2">
		  	<img class="img-polaroid" src="images/user.png"/>
	</div>
	<div class="span4">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'idPerfil.nombre',
				'titulo',
				'nombres',
				'apellidos',
				'cc',
				array('name'=>'fecha_nacimiento', 'value'=>$fecha_nacimiento,''),
				'departamento',
				'ciudad',
				'genero',
				'direccion',
				'barrio',
				'telefono',
				'telefono2',
				'celular',
				'celular2',
				'correo',
			),
		)); ?>
	</div>

	<div class="span4">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'arp',
				'cualarp',
				'pension',
				'cualpension',
				'sangre',
				'aprueba_ordenes',
				'activo',
				'seguimiento',
			),
		)); ?>
		<h3>Información Familiar</h3>
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'nombres_f',
				'apellidos_f',
				'direccion_f',
				'telefono_f',
				'celular_f',
				'parentesco',
			),
		)); ?>
	</div>
</div>

<?php 
	//Contadores para determinar si tiene acceso
	$hayusuario = Usuarios::model()->count("personal_id = $model->id");
	if ($hayusuario > 0) 
	{
		$datosUsuario = Usuarios::model()->findByPk("$model->id");	
	}
?>

<div class="row">
	<div class="span12">
		<h3 class="text-center">Acceso a Sistema</h3>
	</div>
</div>

<div class="row">
	<div class="span4"></div>
	<div class="span4">
		<?php if ($hayusuario > 0)
		{

		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$datosUsuario,
			'attributes'=>array(
				'usuario',
				//'clave',
				'estado',
				'perfilSistema.perfil',
			),
		));
		
		if (Yii::app()->user->perfil == 5) 
		{	
		?>
		<div class="text-center"><a href="index.php?r=usuarios/update&id=<?php echo $model->id; ?>" class="btn btn-small btn-info"><i class="icon-search icon-white"></i>Actualizar Accesos</a></div>
		<?php
		}
		}
		else
		{
		if (Yii::app()->user->perfil == 5) 
		{
		?>
			<div class="text-center"><a href="index.php?r=usuarios/create&id=<?php echo $model->id; ?>" class="btn btn-small btn-info"><i class="icon-search icon-white"></i>Agergar Acceso a Sistema</a></div>
		<?php
		}
		}
		?>

	</div>
	<div class="span4"></div>
</div>
