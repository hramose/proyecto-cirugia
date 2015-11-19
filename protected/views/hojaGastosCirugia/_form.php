<?php
/* @var $this HojaGastosCirugiaController */
/* @var $model HojaGastosCirugia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hoja-gastos-cirugia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

	if(isset($_GET['idCita']))
	{$laCita = $_GET['idCita'];}
	else
	{$laCita = "0";}

	$datosCita = Citas::model()->findByPk($laCita);
	$idPaciente = $datosCita->paciente_id;
	$paciente = Paciente::model()->findByPk($idPaciente); 
?>

<?php 
	//$losProductos = ProductoInventario::model()->findAll("cantidad > 0 and (tipo_inventario = 'Consumibles' or tipo_inventario = 'Medicamento')");
	$losProductos = InventarioPersonalDetalle::model()->findAll("cantidad > 0 and inventario_personal_id = ".Yii::app()->user->usuarioId);
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<div class="span1"></div>
		<div class="span5">
			<h4 class="text-center">Datos de Paciente</h4>
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
			<h4 class="text-center">Datos de Cita</h4>
			<?php 
				if ($datosCita->fecha_cita!='') {
						$fecha_cita=date('d-m-Y',strtotime($datosCita->fecha_cita));
				}else{$fecha_cita=null;}

				$lahora = HorasServicio::model()->findByPK($datosCita->hora_fin + 1);

			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$datosCita,
				'attributes'=>array(			
					array('name'=>'Linea de Servicio', 'value'=>$datosCita->lineaServicio->nombre,''),
					array('name'=>'Fecha de Cita', 'value'=>$fecha_cita,''),
					array('name'=>'Hora de Inicio', 'value'=>$datosCita->horaInicio->hora,''),
					array('name'=>'Hora de Fin', 'value'=>$lahora->hora ,''),
					array('name'=>'Personal', 'value'=>$datosCita->personal->nombreCompleto ,''),
				),
			)); ?>
		</div>
		<div class="span1"></div>
	</div>
<hr>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'fecha_cirugia'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 
				if ($model->fecha_cirugia == '') {
					$fecha_cirugia = '';
				}
				else
				{
					$fecha_cirugia = $model->fecha_cirugia=date('d-m-Y',strtotime($model->fecha_cirugia));	
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_cirugia',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_cirugia',
					'value'=> $fecha_cirugia,
							
					
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
			<?php echo $form->error($model,'fecha_cirugia'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'sala'); ?>
			<?php echo $form->textField($model,'sala', array('class'=>'input-small')); ?>
			<?php echo $form->error($model,'sala'); ?>			
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'peso'); ?>
			<?php echo $form->textField($model,'peso',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'peso'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'tipo_paciente'); ?>
			<?php echo $form->dropDownList($model, 'tipo_paciente',array('Ambulatorio'=>'Ambulatorio'), array('class'=>'input'));?>	
			<?php echo $form->error($model,'tipo_paciente'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'tipo_anestesia'); ?>
			<?php echo $form->dropDownList($model, 'tipo_anestesia',array('Peridural'=>'Peridural', 'Local'=>'Local', 'Raquídea'=>'Raquídea', 'General'=>'General', 'Otro'=>'Otro'), array('class'=>'input'));?>	
			<?php echo $form->error($model,'tipo_anestesia'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'tipo_cirugia'); ?>
			<?php echo $form->dropDownList($model, 'tipo_cirugia',array('Única'=>'Única', 'Bilateral'=>'Bilateral', 'Múltiple'=>'Múltiple'), array('class'=>'input'));?>	
			<?php echo $form->error($model,'tipo_cirugia'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'cirugia'); ?>
			<?php echo $form->textField($model,'cirugia',array('size'=>60,'maxlength'=>150, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'cirugia'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'cirugia_codigo'); ?>
			<?php echo $form->textField($model,'cirugia_codigo',array('size'=>20,'maxlength'=>20, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'cirugia_codigo'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'hora_ingreso'); ?>
			<?php echo $form->textField($model,'hora_ingreso',array('size'=>7,'maxlength'=>7, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'hora_ingreso'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'hora_inicio_cirugia'); ?>
			<?php echo $form->textField($model,'hora_inicio_cirugia',array('size'=>7,'maxlength'=>7, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'hora_inicio_cirugia'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'hora_final_cirugia'); ?>
			<?php echo $form->textField($model,'hora_final_cirugia',array('size'=>7,'maxlength'=>7, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'hora_final_cirugia'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'cirujano_id'); ?>
			<?php echo $form->dropDownList($model, 'cirujano_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' ORDER BY nombres"),'id','nombreCompleto'), array('class'=>'input-xlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'cirujano_id'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'ayudante_id'); ?>
			<?php echo $form->dropDownList($model, 'ayudante_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'  ORDER BY nombres"),'id','nombreCompleto'), array('class'=>'input-xlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'ayudante_id'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'anestesiologo_id'); ?>
			<?php echo $form->dropDownList($model, 'anestesiologo_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'  ORDER BY nombres"),'id','nombreCompleto'), array('class'=>'input-xlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'anestesiologo_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'rotadora_id'); ?>
			<?php echo $form->dropDownList($model, 'rotadora_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'  ORDER BY nombres"),'id','nombreCompleto'), array('class'=>'input-xlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'rotadora_id'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'instrumentadora_id'); ?>
			<?php echo $form->dropDownList($model, 'instrumentadora_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'  ORDER BY nombres"),'id','nombreCompleto'), array('class'=>'input-xlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'instrumentadora_id'); ?>
		</div>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cantidad_productos'); ?>
		<?php //echo $form->textField($model,'cantidad_productos', array('class'=>'input-mini')); ?>
		<?php //echo $form->error($model,'cantidad_productos'); ?>
	</div>

	<hr>

	<input id='variable' name='variable' type='hidden' />
	<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Producto </a>
		<hr>
		<div class="row">

		<div class="span12">

		<table class "table" width="100%">
			<tr>
				<th width="5%"><small>Codigo</small></th>
				<th width="20%"><small>Producto</small></th>
				<th width="15%"><small>Cant.</small></th>
				<th width="10%"><small>Unid. de Medida</small></th>
				<th width="10%"></th>
			</tr>
		</table>

	   <div id="contenedorcampos">
	   
	   </div>
	   </div>
	</div>

	<hr>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">


$(document).ready( agregarCampo );

	var variableJs = 0;
	var campos = 1;
	var eltotal = 0;

function agregarCampo(){

	campos = campos + 1;
	variableJs = campos;
	var NvoCampo= document.createElement("div");
	NvoCampo.id= "divcampo_"+(campos);
	NvoCampo.innerHTML= 
		"<table class='table'>" +
		"   <tr>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text'  readonly='readonly' class='input-mini' placeholder='' name='codigo_" + campos + "' id='codigo_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"		 <select class='input-xlarge' name='producto_" + campos + "' id='producto_" + campos + "'>" +
		"			<option value='0'></option>"+
		"			<?php foreach($losProductos as $los_productos){ ?>"+
		"			<option value='<?php echo $los_productos->producto_id; ?>'><?php echo $los_productos->producto->nombre_producto; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input' placeholder='' name='medida_" + campos + "' id='medida_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='hidden' class='input-small' placeholder='' name='existencia_" + campos + "' id='existencia_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	
	$("#variable").val(variableJs);

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);
    

	//Busqueda de productos
	jQuery(document).ready(function($) {       
	$("#producto_" + campos +"").change(function(e) {
		//Saber posición actual
        			var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=hojaGastosCirugia/producto",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("Error petición ajax");
                    },
                    success: function(data){
                    
                         // $("#resultado").empty();

                          var variable = jQuery.parseJSON(data);
                          //alert(variable.presentacion);
                          $("#codigo_" + posicion + "").val(variable.referencia);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#medida_" + posicion + "").val(variable.medida);
                          $("#existencia_" + posicion + "").val(eval(variable.stock));
                          superTotal();
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });
    });



$("#cantidad_"+ campos + "").keyup(function (){
	var posicion = this.name.replace(/[^\d]/g, '');
    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
    //si la cantidad es cero no hacer nada
     if ($(this).val() == "" || $(this).val() == "0") 
    	{
    		$("#total_"+ posicion + "").val(0);		
    		
    	}
    	else
    	{
    		//Calcular el total de cada producto
    		var eltotal = eval($("#valor_"+ posicion + "").val()) * eval($(this).val());
    		$("#total_"+ posicion + "").val(eltotal);		
    	}
    	
    	//Verificar existencias
    	if ($(this).val() > eval($("#existencia_"+ posicion + "").val())) 
    	{
    		sweetAlert("Oops...", "No hay más producto del requerido. Solo hay "+$("#existencia_"+ posicion + "").val()+" en existencia", "error");
    		$(this).val(eval($("#existencia_"+ posicion + "").val()));
    	}

});


}



function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
  superTotal();
  //variableJs = variableJs-1;
}

</script>