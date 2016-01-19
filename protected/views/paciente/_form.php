<?php
/* @var $this PacienteController */
/* @var $model Paciente */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paciente-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="hero-unit">
	<h3>Información Personal</h3>
	<hr class="linea-titulo">
	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'nombre'); ?>
			<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'nombre'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'apellido'); ?>
			<?php echo $form->textField($model,'apellido',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'apellido'); ?>
		</div>
	</div>	
	
	

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'n_identificacion'); ?>
			<?php echo $form->textField($model,'n_identificacion',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'n_identificacion'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'genero'); ?>
			<?php echo $form->dropDownList($model, 'genero',array('1'=>'Indefinido','2'=>'Femenino', '3'=>'Masculino'));?>	
			<?php echo $form->error($model,'genero'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 
				if ($model->fecha_nacimiento == '') {
					$fecha_nacimiento = '';
				}
				else
				{
					$fecha_nacimiento = $model->fecha_nacimiento=date('d-m-Y',strtotime($model->fecha_nacimiento));	
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_nacimiento',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_nacimiento',
					'value'=> $fecha_nacimiento,
							
					
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'1920:2000',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				));


				?>
			</div>
			<?php echo $form->error($model,'fecha_nacimiento'); ?>
		</div>

		
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'ocupacion'); ?>
			<?php echo $form->textField($model,'ocupacion',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'ocupacion'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'estado_civil'); ?>
			<?php echo $form->dropDownList($model, 'estado_civil',array('Indefinido'=>'Indefinido','Soltero/a'=>'Soltero/a', 'Casado/a'=>'Casado/a', 'Divorciado/a'=>'Divorciado/a', 'Viudo/a'=>'Viudo/a', 'Unión Libre'=>'Unión Libre', 'Separado/a'=>'Separado/a'), array('class'=>'input-medium'));?>	
			<?php echo $form->error($model,'estado_civil'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'Aseguradora'); ?>
			<?php echo $form->textField($model,'Aseguradora',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'Aseguradora'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'tipo_vinculacion'); ?>
			<?php echo $form->dropDownList($model, 'tipo_vinculacion',array('Beneficiario'=>'Beneficiario','Cotizante'=>'Cotizante'), array('class'=>'input-medium'));?>	
			<?php echo $form->error($model,'tipo_vinculacion'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'tratamiento_interes_id'); ?>
			<?php echo $form->dropDownList($model, 'tratamiento_interes_id',CHtml::listData(TratamientoInteres::model()->findAll("estado = 'activo' order by 'name'"),'id','name'), array('class'=>'input-xlarge'));?>
			<?php echo $form->error($model,'tratamiento_interes_id'); ?>
		</div>
		
		<div class="span5">
				
		</div>
	</div>
</div>


<div class="hero-unit">
	<h3>Datos de Contacto</h3>
	<hr class="linea-titulo">
	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'email2'); ?>
			<?php echo $form->textField($model,'email2',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'email2'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'telefono1'); ?>
			<?php echo $form->textField($model,'telefono1',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'telefono1'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'telefono2'); ?>
			<?php echo $form->textField($model,'telefono2',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'telefono2'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'celular'); ?>
			<?php echo $form->textField($model,'celular',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'celular'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'direccion'); ?>
			<?php echo $form->textArea($model,'direccion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'direccion'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'ciudad'); ?>
			<?php echo $form->textField($model,'ciudad',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'ciudad'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'pais'); ?>
			<?php echo $form->textField($model,'pais',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'pais'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'estado'); ?>
			<?php echo $form->dropDownList($model, 'estado',array('1'=>'Activo','0'=>'Inactivo'), array('class'=>'input-medium'));?>	
			<?php echo $form->error($model,'estado'); ?>
		</div>
	</div>
</div>


<div class="hero-unit">
	<h3>Información de Acompañante y/o Responsable</h3>
	<hr class="linea-titulo">
	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'nombre_acompanante'); ?>
			<?php echo $form->textField($model,'nombre_acompanante',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'nombre_acompanante'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'acompanante_telefono'); ?>
			<?php echo $form->textField($model,'acompanante_telefono',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'acompanante_telefono'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'nombre_responsable'); ?>
			<?php echo $form->textField($model,'nombre_responsable',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'nombre_responsable'); ?>
		</div>
		
		<div class="span5">
			<?php echo $form->labelEx($model,'telefono_responsable'); ?>
			<?php echo $form->textField($model,'telefono_responsable',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'telefono_responsable'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'relacion_responsable'); ?>
			<?php echo $form->textField($model,'relacion_responsable',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'relacion_responsable'); ?>
		</div>


	</div>

	<h3>Fuente del Contacto</h3>
	<hr class="linea-titulo">
	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'fuente_contacto_id'); ?>
			<?php echo $form->dropDownList($model, 'fuente_contacto_id', CHtml::listData(FuenteContacto::model()->findAll(), 'id', 'fuente'), array('empty'=>'(Seleccione)'), array('class'=>'input-xlarge'));?>
			<?php echo $form->error($model,'fuente_contacto_id'); ?>
		</div>
	</div>

	<h3>Observaciones</h3>
	<hr class="linea-titulo">
	<div class="row">
		<div class="span5">
			<?php //echo $form->labelEx($model,'fuente_contacto_id'); ?>
			<?php echo $form->textArea($model, 'observaciones', array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge'));?>
			<?php echo $form->error($model,'observaciones'); ?>
		</div>
	</div>
	
</div>
<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn-info btn-large')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->