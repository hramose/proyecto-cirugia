<?php
/* @var $this InventarioPersonalController */
/* @var $model InventarioPersonal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventario-personal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php 
	//Temporal
	//$losProductos = ProductoInventario::model()->findAll("cantidad > 0");
	$losProductos = ProductoInventarioDetalle::model()->findAll("existencia > 0");
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'personal_id'); ?>
		<?php echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and NOT EXISTS(select personal_id from inventario_personal where inventario_personal.personal_id = id) ORDER BY nombres ASC"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
		<?php echo $form->error($model,'personal_id'); ?>
	</div>
	<input id='variable' name='variable' type='hidden' />
	

	<h5>Agregar Productos a Inventario Personal</h5>
	<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Producto </a>
	<hr>
	<div class="row">

		<div class="span12">

		<table class "table" width="100%">
			<tr>
				<th width="8%"><small>Codigo</small></th>
				<th width="25%"><small>Producto</small></th>
				<th width="12%"><small>Lote</small></th>
				<th width="21%"><small>Presentación</small></th>
				<th width="21%"><small>Unidad de Medida</small></th>
				<th width="10%"><small>Cant.</small></th>
				<th width="0%"></th>
			</tr>
		</table>

	   <div id="contenedorcampos">
	   
	   </div>
	   </div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">


$(document).ready( agregarCampo );

	var variableJs = 0
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
		"			<option value='<?php echo $los_productos->id; ?>'><?php echo $los_productos->productoInventario->nombre_producto . ' - ' . $los_productos->lote; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-small' placeholder='' name='lote_" + campos + "' id='lote_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-normal' placeholder='' name='presentacion_" + campos + "' id='presentacion_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-normal' placeholder='' name='unidad_" + campos + "' id='unidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='hidden' class='input-small' placeholder='' name='existencia_" + campos + "' id='existencia_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='hidden' class='input-small' placeholder='' name='id_producto_" + campos + "' id='id_producto_" + campos + "'>" +
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
                    url: "index.php?r=inventarioPersonal/producto",
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
                          $("#presentacion_" + posicion + "").val(variable.presentacion);
                          $("#lote_" + posicion + "").val(variable.lote);
                          $("#unidad_" + posicion + "").val(variable.unidad);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#existencia_" + posicion + "").val(eval(variable.stock));
                          $("#id_producto_" + posicion + "").val(variable.idProducto);
                          superTotal();
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });
    });


$("#cantidad_"+ campos + "").keyup(function (){
	var posicion = this.name.replace(/[^\d]/g, '');
    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
       	
    	//Verificar existencias
    	if ($(this).val() > eval($("#existencia_"+ posicion + "").val())) 
    	{
    		sweetAlert("Oops...", "No hay más producto del requerido. Solo hay "+$("#existencia_"+ posicion + "").val()+" en existencia", "error");
    		$(this).val(eval($("#existencia_"+ posicion + "").val()));
    	}

    	superTotal();

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