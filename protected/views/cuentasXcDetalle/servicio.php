<?php
/* @var $this CuentasXcController */
/* @var $model CuentasXc */

$this->menu=array(
	//array('label'=>'List CuentasXc', 'url'=>array('index')),
	//array('label'=>'Create CuentasXc', 'url'=>array('create')),
	array('label'=>'Cuentas por Paciente', 'url'=>"index.php?r=cuentasXc/admin"),
	array('label'=>'Cuentas por Contrato', 'url'=>"index.php?r=cuentasXcDetalle/contratos"),
	array('label'=>'Cuentas por Servicio', 'url'=>"index.php?r=cuentasXcDetalle/servicio"),
);

?>

<h1>Cuentas por Cobrar por Linea de Servicio sin Contrato</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cuentas-xc-grid',
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		array(
			'header'=>'Paciente',
			'name'=>'paciente_id',
			'filter'=>CHtml::listData(Paciente::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'paciente\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		'n_identificacion',
		array(
			'header'=>'Linea de Servicio',
			'name'=>'linea_servicio_id',
			'filter'=>CHtml::listData(LineaServicio::model()->findAll(), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'linea\'][\'nombre\']',
		),
		'cita_id',
		array(
			'name'=>'saldo',
			'value'=>'number_format($data->saldo,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>"<h5>$ ".number_format($model->search()->itemCount===0 ? '' : $model->getTotal2($model->search2()),2).'</h5>',
		),
		array(
			'class'=>'CButtonColumn',
			//'template'=>'{view}',
			'template'=>'',
		),
	),
)); ?>


<script>
$(document).ready(function()
    {
        $('body').on('dblclick', '#cuentas-xc-grid tbody tr', function(event)
        {
                var citaID= $(this).find('td:nth-child(5)').text();
                
            location.href = '<?php echo Yii::app()->createUrl('citas/view'); ?>&id=' + citaID;
        });
    });
</script>