<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'id_perfil'); ?>
		<?php echo $form->dropDownList($model, 'id_perfil',CHtml::listData(Perfil::model()->findAll("estado = 'Activo'"),'id','nombre'), array('class'=>'input-large'));?>
		<a href="index.php?r=Perfil/create" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Agregar</a>
		<?php echo $form->error($model,'id_perfil'); ?>
	</div>

	<div class="row">
		
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->dropDownList($model, 'titulo',array(''=>'','Dra.'=>'Dra.', 'Dr.'=>'Dr.'), array('class'=>'input-small'));?>	
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'nombres'); ?>
			<?php echo $form->textField($model,'nombres',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'nombres'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'apellidos'); ?>
			<?php echo $form->textField($model,'apellidos',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'apellidos'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'cc'); ?>
			<?php echo $form->textField($model,'cc',array('size'=>60,'maxlength'=>254)); ?>
			<?php echo $form->error($model,'cc'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'expedicion'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 
				if ($model->expedicion == '') {
					$expedicion = '';
				}
				else
				{
					$expedicion = $model->expedicion=date('d-m-Y',strtotime($model->expedicion));	
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'expedicion',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'expedicion',
					'value'=> $expedicion,
							
					
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'1980:2020',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				));


				?>
			</div>
			<?php echo $form->error($model,'expedicion'); ?>
		</div>		
	</div>

	<div class="row">

		<div class="span4">
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
		<div class="span4">
			<?php echo $form->labelEx($model,'departamento'); ?>
			<?php echo $form->textField($model,'departamento',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'departamento'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'ciudad'); ?>
			<?php echo $form->textField($model,'ciudad',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'ciudad'); ?>
		</div>
		
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'genero'); ?>
			<?php echo $form->dropDownList($model, 'genero',array('Femenino'=>'Femenino', 'Masculino'=>'Masculino'), array('class'=>'input-medium'));?>	
			<?php echo $form->error($model,'genero'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textArea($model,'direccion',array('rows'=>4, 'cols'=>60, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'barrio'); ?>
		<?php echo $form->textField($model,'barrio',array('size'=>120,'maxlength'=>120, 'class'=>'input-xlarge')); ?>
		<?php echo $form->error($model,'barrio'); ?>
	</div>

	
	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'telefono'); ?>
			<?php echo $form->textField($model,'telefono',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'telefono'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'telefono2'); ?>
			<?php echo $form->textField($model,'telefono2',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'telefono2'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'celular'); ?>
			<?php echo $form->textField($model,'celular',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'celular'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'celular2'); ?>
			<?php echo $form->textField($model,'celular2',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'celular2'); ?>
		</div>
	</div>
	

	<div class="row">

		<div class="span4">
			<?php echo $form->labelEx($model,'correo'); ?>
			<?php echo $form->textField($model,'correo',array('size'=>60,'maxlength'=>60)); ?>
			<?php echo $form->error($model,'correo'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'correo2'); ?>
			<?php echo $form->textField($model,'correo2',array('size'=>60,'maxlength'=>60)); ?>
			<?php echo $form->error($model,'correo2'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'arp'); ?>
		<?php echo $form->dropDownList($model, 'arp',array('NO'=>'NO','SI'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'arp'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'cualarp'); ?>
			<?php echo $form->textField($model,'cualarp',array('size'=>60,'maxlength'=>60)); ?>
			<?php echo $form->error($model,'cualarp'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'pension'); ?>
			<?php echo $form->dropDownList($model, 'pension',array('NO'=>'NO','SI'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'pension'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'cualpension'); ?>
			<?php echo $form->textField($model,'cualpension',array('size'=>60,'maxlength'=>60)); ?>
			<?php echo $form->error($model,'cualpension'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sangre'); ?>
		<?php echo $form->textField($model,'sangre',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'sangre'); ?>
	</div>


<h2>Información Familiar</h2>
<hr>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'nombres_f'); ?>
			<?php echo $form->textField($model,'nombres_f',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'nombres_f'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'apellidos_f'); ?>
			<?php echo $form->textField($model,'apellidos_f',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'apellidos_f'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_f'); ?>
		<?php echo $form->textArea($model,'direccion_f',array('rows'=>4, 'cols'=>60, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'direccion_f'); ?>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'telefono_f'); ?>
			<?php echo $form->textField($model,'telefono_f',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'telefono_f'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'celular_f'); ?>
			<?php echo $form->textField($model,'celular_f',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'celular_f'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parentesco'); ?>
		<?php echo $form->textField($model,'parentesco',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'parentesco'); ?>
	</div>

<div class="row">
	<div class="span10"></div>
</div>


<div class="row">
<div class="hero-unit span4">
	<h3>Perfiles de Sistema</h3>
	<hr class="linea-titulo">
	<div class="row">
		<?php echo $form->labelEx($model,'agenda'); ?>
		<?php echo $form->dropDownList($model, 'agenda',array('No'=>'No','SI'=>'Si'), array('class'=>'input-mini'));?>	
		<?php echo $form->error($model,'agenda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aprueba_ordenes'); ?>
		<?php echo $form->dropDownList($model, 'aprueba_ordenes',array('No'=>'No','SI'=>'Si'), array('class'=>'input-mini'));?>	
		<?php echo $form->error($model,'aprueba_ordenes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seguimiento'); ?>
		<?php echo $form->dropDownList($model, 'seguimiento',array('No'=>'No','SI'=>'Si'), array('class'=>'input-mini'));?>	
		<?php echo $form->error($model,'seguimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->dropDownList($model, 'activo',array('SI'=>'Si','NO'=>'NO'), array('class'=>'input-mini'));?>	
		<?php echo $form->error($model,'activo'); ?>
	</div>
</div>
</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->