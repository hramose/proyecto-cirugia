<?php
/* @var $this CitasController */
/* @var $model Citas */
?>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<!DOCTYPE html>
<html>
<body>
	<head>
		
	</head>
<div class="container">
	<div class="row-fluid">
		
			<div class="span2"></div>
			<div class="span6">
				<h1 class="text-center">Consultar Citas</h1>
				<br>
				<center>
				<img src="images/calendario.png">
				</center>
				<br>
				
<?php 
$laurl = "index.php?r=imprimir/Huespedes&pdf=T";
?>
				<div class="well text-center">
					<p><b>Seleccione el Especialista</b></p>
					<?php 
						$elPersonal = Perfil::model()->findAll("Estado = 'Activo' and agenda = 'Si'");
			 			foreach ($elPersonal as $el_personal) 
			 			{
			 			echo CHtml::submitButton($el_personal->nombre, array('submit'=>array('citas/calendario&idpersonal='.$el_personal->id), 'class'=>'btn btn-primary'))."  ";

						}	 
					?>
					<br><br>
					<a href="index.php?r=citasReservada/admin" class="btn btn-danger"><i class="icon-remove-circle icon-white"></i> Bloquear Agenda</a>
				</div>

			</div>
			<div class="span4">
				
			</div>
	</div>
</div>
</body>
</html>