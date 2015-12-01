<h3>Estos seran los pendientes por usuario</h3>
<div class="row">
	<div class="span6">
		<div class="hero-unit text-center">
			<h4>Citas programadas para ahora</h4>
			<h1><img src="images/citasHoy.png"/><?php 
			if ($citasHoy > 0) 
			{
				?>
					<a href="index.php?r=citas/admin&programadas=1"><?php echo $citasHoy; ?></a>
				<?php
			}
			?>
			</h1>
		</div>
	</div>
	<div class="span6">
		<div class="hero-unit text-center">
			<h4>Seguimientos comerciales programados para ahora</h4>
			<h1><img src="images/seguimientosHoy.png"> <?php 
			if ($seguimientosHoy > 0) 
			{
				?>
					<a href="index.php?r=seguimientoComercial/admin&filtro=1&usuario=1"><?php echo $seguimientosHoy; ?></a>
				<?php
			}
			?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="span6">
		<div class="hero-unit text-center">
			<h4>Citas vencidas</h4>
			<h1><img src="images/citaVencida.png"/> <?php 
			if ($citasVencidas > 0) 
			{
				?>
					<a href="index.php?r=citas/admin&vencidas=1"><?php echo $citasVencidas; ?></a>
				<?php
			}
			?></h1>
		</div>
	</div>
	<div class="span6">
		<div class="hero-unit text-center">
			<h4>Seguimientos vencidos</h4>
			<h1><img src="images/seguimientoVencidos.png"> <?php 
			if ($seguimientosVencidos > 0) 
			{
				?>
					<a href="index.php?r=seguimientoComercial/admin&filtro=3&vencidos=1"><?php echo $seguimientosVencidos; ?></a>
				<?php
			}
			?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="span6">
		<div class="hero-unit text-center">
			<h4>Tareas asignadas</h4>
			<h1><img src="images/tareasProgramada.png"/> <?php 
			if ($tareas > 0) 
			{
				?>
					<a href="index.php?r=personalTareas/admin&filtro=1&usuario=1"><?php echo $tareas; ?></a>
				<?php
			}
			?></h1>
		</div>
	</div>
	<div class="span6">
		<div class="hero-unit text-center">
			<h4>Tareas vencidas</h4>
			<h1><img src="images/tareasVencidas.png"> <?php 
			if ($tareasVencidas > 0) 
			{
				?>
					<a href="index.php?r=personalTareas/admin&filtro=2&usuario=1"><?php echo $tareasVencidas; ?></a>
				<?php
			}
			?></h1>
		</div>
	</div>
</div>