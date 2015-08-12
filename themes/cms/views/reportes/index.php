<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<html>
<div class="container">
	<div class="row-fluid">
		
			<div class="span4"></div>
			<div class="span4">
				<h1 class="text-center">Maestro Reportes</h1>
				<br>
				<center>
				<img src="images/impresor_grande.png">
				</center>
				<br>
			
			<ul class="nav nav-list">
			  <li class="active"><a href="#"><i class="icon-home icon-white"></i> Seleccione el Reporte</a></li>
			  <li><?php echo CHtml::link('<i class="icon-user"></i> Huespedes', $this->createAbsoluteUrl('reportes/huespedes',array())); ?></li>
			  <li><?php echo CHtml::link('<i class="icon-bell"></i> Reservaciones', $this->createAbsoluteUrl('reportes/reservaciones',array())); ?></li>
			</ul>
			</div>
			<div class="span4"></div>
	</div>
</div>
</html>