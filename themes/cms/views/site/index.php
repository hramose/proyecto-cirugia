<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<style type="text/css"> 
header[role=banner] {
	/*position:absolute;*/
	width: 101%;
	padding: 5px 0px 5px 0px;
	text-align: left;
	background-color: rgba(0,0,0,.1);
	margin-bottom: 60px;
	font-size: 1.25em;
	left:0px;
	top:70px;
	
	
	margin: 1em auto 2em;
	background-color: #333;
	background-image: -webkit-linear-gradient(#333, #222);
	-webkit-box-shadow: inset 0px -15px 50px rgba(0, 0, 0, 0.6);
	box-shadow: inset 0px -15px 50px rgba(0, 0, 0, 0.6);
	
	background-image: -webkit-linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent),-webkit-linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent);
	background-image: -o-linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent),-o-linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent);
	background-image: -ms-linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent),-ms-linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent);
	background-image: linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent),linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.05) 75%, rgba(255, 255, 255, 0.05) 76%, transparent 77%, transparent);	
	
	
	background-size: 50px 50px;


}

header h1 {
	font-size: 4em;
	line-height: 1;
	color: white;
	letter-spacing: -.03em;
	margin-left: 7%;
	text-shadow:0px 0px 12px #000000;
}

header h2 {
	line-height: 1;
	color: white;
	margin-left: 7%;
}

.latabla{
margin-bottom: 200px;
}
</style>
<div class="row">
	<header role="banner">
		<table>
		<tr>
		<td width=75%>
			<h1>Smadia Clinic</h1>
			<h2>Smadia Clinic</h2>
		</td>
		<td>
		<img src="images/empleados.png"/></div>
		</td>
		</tr>
		</table>		
	</header>
</div>


<!--Contadores -->
<?php 
$pacientes = Paciente::model()->count();
$citas = Citas::model()->count("fecha_cita = '".date('Y-m-d')."' and estado = 'Programada'");
$seguimientos = SeguimientoComercial::model()->count("fecha_accion = '".date('Y-m-d')."'");
$vencidas = Citas::model()->count("estado = 'Vencida'");
$inventario = InventarioPersonal::model()->count("personal_id = ".Yii::app()->user->usuarioId);

$tareas = 0;
if (!Yii::app()->user->isGuest) 
{
	$tareas = PersonalTareas::model()->count("estado = 'Activa' and personal_id = ".Yii::app()->user->usuarioId);
}


?>


<div class="row">
	<div class = "span4">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"<b>Pacientes Registrados</b>",
			));
			
		?>
		<div class="row">
		    <div class="span2">
		    	<h3>Total:</h3>
		    	<h1><?php echo $pacientes; ?></h1>
		    </div>
		    
		    <div class="span1">
		    	<img src="images/user.png"/>
		    </div>
	    </div>
	    
	    
	    <?php $this->endWidget();?>

		<div class="row">
		    <div class="span4 text-center">
		    	<a href="index.php?r=personal/pendientes" class="btn btn-primary"><i class="icon-list-alt icon-white"></i> Consulta tus pendientes</a>
		    </div>
		    <br>
		    <br>
			<?php if (Yii::app()->user->perfil==2 and $inventario > 0): ?>
				<div class="span4 text-center">
			    	<a href="index.php?r=InventarioPersonal/view&id=<?php echo Yii::app()->user->usuarioId; ?>" class="btn btn-warning"><i class="icon-list-alt icon-white"></i> Ver Inventario Personal</a>
			    </div>
			<?php endif ?>
	    </div>
	    <br>
	    <?php
	    if ($tareas > 0) 
	    {
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"<b>Tareas Asignadas</b>",
			));
			
		?>
		<div class="row">
		    <div class="span2">
		    	<h3>Total:</h3>
		    	<h1><?php echo $tareas; ?></h1>
		    </div>
		    
		    <div class="span1">
		    	<img src="images/todo.png"/>
		    	<a href="index.php?r=personalTareas/admin&personalId=<?php echo Yii::app()->user->usuarioId; ?>" class="btn btn-mini btn-primary">Ver Tareas</a>
		    </div>
	    </div>
	    <?php $this->endWidget();
		}
	    ?>
	</div>
	
	<div class = "span3">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"<b>Citas</b>",
			));
			
		?>
	    
	    <h3>Programadas para Hoy: <span class="label label-info"><?php echo date("d-m-Y")?></span></h3>
	    <div class="hero-unit text-center">
		    <h1 class = "text-center">
		    	<span class="text-error"><?php echo $citas; ?></span>
		    </h1>
		    <a href="index.php?r=citas/citas" class="btn btn-mini btn-warning"><i class="icon-calendar icon-white"></i> Ver Agenda</a>
		</div>
	    
	    <?php $this->endWidget();?>
	</div>
	
	<div class = "span3">
		<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>"<b>Seguimiento Comercial</b>",
				));		
		?>
		    
		    <h3>Programados para Hoy: <span class="label label-info"><?php echo date("d-m-Y")?></span></h3>
		    <div class="hero-unit text-center">
			    <h1 class = "text-center">
			    	<span class="text-error"><?php echo $seguimientos; ?></span>
			    </h1>
			    <a href="index.php?r=seguimientoComercial/admin&filtro=1" class="btn btn-mini btn-success"><i class="icon-calendar icon-white"></i> Ver Seguimiento</a>
			</div>
	    
	    <?php $this->endWidget();?>
	</div>

	<div class = "span3">
		<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>"<b>Citas Vencidas</b>",
				));		
		?>
		    
		    <h3>Hasta la fecha: <br><span class="label label-info"><?php echo date("d-m-Y")?></span></h3>
		    <div class="hero-unit text-center">
			    <h1 class = "text-center">
			    	<span class="text-error"><?php echo $vencidas; ?></span>
			    </h1>
			    <a href="index.php?r=citas/admin" class="btn btn-mini btn-success"><i class="icon-calendar icon-white"></i> Ver Citas</a>
			</div>
	    
	    <?php $this->endWidget();?>
	</div>
	
</div>
	

<body>	


</body>
	
