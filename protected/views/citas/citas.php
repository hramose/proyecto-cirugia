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
					<?php 
						$elPersonal = Perfil::model()->findAll("Estado = 'Activo' and agenda = 'Si'");
			 			foreach ($elPersonal as $el_personal) 
			 			{
			 			echo CHtml::submitButton($el_personal->nombre, array('submit'=>array('citas/calendario&idpersonal='.$el_personal->id), 'class'=>'btn-large btn-primary'))."<br><br>";

						}	 
					?>
				</div>

			</div>
			<div class="span4">
				
			</div>
	</div>
</div>
</body>
</html>