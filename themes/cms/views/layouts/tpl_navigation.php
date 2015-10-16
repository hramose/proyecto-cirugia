<!--Contadores para menu-->

<?php 

//$pendientes = Reservacion::model()->count("cambio_tarifa = 'Pendiente'"); //Reservadas
$perfiles = Perfil::model()->find("estado='Activo'");


?>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#"><?php /*echo CHtml::encode($this->pageTitle); */?>Smadia Clinic</a>
          
          <div class="nav-collapse">
			<?php 
            if (!Yii::app()->user->isGuest) 
            {
            $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'<i class="icon-home icon-white"></i>', 'url'=>array('/site/index')),
                        //array('label'=>'Formularios', 'url'=>array('/site/page', 'view'=>'forms')),
                        //array('label'=>'Tablas', 'url'=>array('/site/page', 'view'=>'tables')),
                        //array('label'=>'Solicitudes', 'url'=>array('/correspondencia', 'view'=>'tables')
                        array('label'=>'<i class="icon-user icon-white"></i> Pacientes <span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 6 or Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 4 or Yii::app()->user->perfil == 3 or Yii::app()->user->perfil == 2 or Yii::app()->user->perfil == 1, 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                array('label'=>'Ingresar', 'url'=>array('/paciente/create')),
                                array('label'=>'Buscar', 'url'=>array('/paciente/admin')),
                                array('label'=>'<li class="divider"></li>'),
                                array('label'=>'<li class="nav-header">Seguimiento Comercial</li>'),
                                array('label'=>'Seguimiento Comercial Abiertos', 'url'=>array('/seguimientoComercial/admin&filtro=1')),
                                array('label'=>'Seguimiento Comercial Cerrados', 'url'=>array('/seguimientoComercial/admin&filtro=2')),
                                array('label'=>'Seguimiento Comercial Vencidos', 'url'=>array('/seguimientoComercial/admin&filtro=3')),
                        )),

                        array('label'=>'<i class="icon-calendar icon-white"></i> Agenda <span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 1 or Yii::app()->user->perfil == 2 or Yii::app()->user->perfil == 3 or Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 6,'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                    array('label'=>'Agenda de Citas', 'url'=>array('/citas/citas')),
                                    array('label'=>'Listado de Citas', 'url'=>array('/citas/admin')),
                                    array('label'=>'<li class="divider"></li>'),
                                    array('label'=>'Agenda de Equipos', 'url'=>array('/citasEquipo/admin')),

                        )),

                        array('label'=>'<i class="icon-briefcase icon-white"></i> Contratos <span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 6 or Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 3 or Yii::app()->user->perfil == 2 or Yii::app()->user->perfil == 1, 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                array('label'=>'Listado de Contratos', 'url'=>array('/contratos/admin')),
                                array('label'=>'Listado de Presupuestos', 'url'=>array('/Presupuesto/admin')),
                        )),

                        array('label'=>'<i class="icon-leaf icon-white"></i> Asistenciales <span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 6 or Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 3 or Yii::app()->user->perfil == 2, 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                array('label'=>'Pagos a Asistenciales', 'url'=>array('/PagoCosmetologas/admin')),
                                /*array('label'=>'Ordenes de Pago', 'url'=>array('/pacienteOrden/create')),*/
                                /*array('label'=>'Autorizaciones Pendientes <span class="badge badge-success pull-right">'.$pendientes.'</span>', 'url'=>array('/reservacion/autorizar'), 'visible'=> !Yii::app()->user->isGuest and Yii::app()->user->cargo == "Administrador"),*/                                                       
                        )),

                        array('label'=>'<i class="icon-inbox icon-white"></i> Caja <span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 6 or Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 4, 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                array('label'=>'Cuentas por Cobrar', 'url'=>array('/cuentasXc/admin')),
                                array('label'=>'Cuentas por Pagar', 'url'=>array('/ProductoCompras/cxp')),
                                array('label'=>'Cuentas por Pagar Pagadas', 'url'=>array('/ProductoCompras/cxpp')),
                                array('label'=>'Notas de Crédito', 'url'=>array('/NotaCredito/admin')),
                                array('label'=>'Relación Hoja de Gastos', 'url'=>array('/RelacionHojaGastos/admin')),
                                array('label'=>'Ingresos', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                             'items' => array(
                            //     array('label'=>'Generar Ingreso', 'url'=>array('#')),
                                array('label'=>'Listado de Ingresos', 'url'=>array('/ingresos/admin')),
                                )),
                                array('label'=>'Egresos', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                            'items' => array(
                                array('label'=>'Generar Egreso', 'url'=>array('/egresos/create')),
                                array('label'=>'Listado de Egresos', 'url'=>array('/egresos/admin')),
                                //array('label'=>'Exportar Egresos', 'url'=>array('/cajaEfectivo/index')),
                                )),
                                array('label'=>'Ventas', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                            'items' => array(
                                array('label'=>'Generar una Venta', 'url'=>array('/ventas/create')),
                                array('label'=>'Listado de Ventas Realizadas', 'url'=>array('/ventas/admin')),
                                array('label'=>'Relación de Productos', 'url'=>array('/ventasDetalle/admin')),
                                )),
                                array('label'=>'Estado de Caja', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                            'items' => array(
                                array('label'=>'Saldo', 'url'=>array('/cajaEfectivo/index')),
                                )),
                                /*array('label'=>'Ordenes de Pago', 'url'=>array('/pacienteOrden/create')),*/
                                /*array('label'=>'Autorizaciones Pendientes <span class="badge badge-success pull-right">'.$pendientes.'</span>', 'url'=>array('/reservacion/autorizar'), 'visible'=> !Yii::app()->user->isGuest and Yii::app()->user->cargo == "Administrador"),*/                                                       
                        )),

                        array('label'=>'<i class="icon-th-list icon-white"></i> Invetario <span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 3 or Yii::app()->user->perfil == 4, 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                array('label'=>'Inventarios Personales', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                                'items' => array(
                                    array('label'=>'Inventarios', 'url'=>array('/InventarioPersonal/admin')),
                                    array('label'=>'Crear Inventario', 'url'=>array('/InventarioPersonal/create')),

                                    )),
                                array('label'=>'Inventario de Productos', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                                'items' => array(
                                    array('label'=>'Presentación de Productos', 'url'=>array('/ProductoPresentacion/admin')),
                                    array('label'=>'Categoría de Productos', 'url'=>array('/ProductoCategoria/admin')),
                                    array('label'=>'Unidad de Medida de Productos', 'url'=>array('/ProductoUnidadMedida/admin')),
                                    array('label'=>'Proveedor de Productos', 'url'=>array('/ProductoProveedor/admin')),
                                    array('label'=>'Ingresar Producto a Inventario', 'url'=>array('/ProductoInventario/create')),
                                    array('label'=>'Listar Inventario', 'url'=>array('/ProductoInventario/admin&tipo=0')),

                                    )),            
                                array('label'=>'Compra de Productos', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                                'items' => array(
                                    array('label'=>'Ingresar Compra', 'url'=>array('/ProductoCompras/create')),
                                    array('label'=>'Listar Compras', 'url'=>array('/ProductoCompras/admin')),

                                    )),                          
                                    array('label'=>'Inventario de Activos', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                                'items' => array(
                                    //array('label'=>'Categoría de Activos', 'url'=>array('/ActivoCategoria/admin')),
                                    array('label'=>'Ingresar Activo a Inventario', 'url'=>array('/ActivoInventario/create')),
                                    array('label'=>'Listar Activos', 'url'=>array('/ActivoInventario/admin')),
                                    )),                              
                                    array('label'=>'Orden de Pedido', 'url'=>array('/OrdenPedido/admin')),
                             )),

                        array('label'=>'<i class="icon-wrench icon-white"></i><span class="caret"></span>', 'visible'=>Yii::app()->user->perfil == 2 or Yii::app()->user->perfil == 3 or Yii::app()->user->perfil == 5 or Yii::app()->user->perfil == 6, 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                                array('label'=>'Personal', 'url'=>array('/Personal/admin')),
                                array('label'=>'Lineas de Servicio', 'url'=>array('/LineaServicio/admin')),
                                array('label'=>'Equipos', 'url'=>array('/Equipos/admin')),  
                                array('label'=>'Tratamientos de Interes', 'url'=>array('/TratamientoInteres/admin')),
                                array('label'=>'Fuente de Contacto', 'url'=>array('/FuenteContacto/admin')),
                                array('label'=>'Centro de Costo', 'url'=>array('/CentroCosto/admin')),
                                array('label'=>'Bancos', 'url'=>array('/Bancos/admin')),
                                array('label'=>'Temas de Seguimiento', 'url'=>array('/SeguimientoTema/admin')),
                                array('label'=>'Productos de Formulación', 'url'=>array('/Formulacion/admin')), 
                                array('label'=>'Laboratorios', 'url'=>array('/Laboratorio/admin')), 
                                array('label'=>'Medicamentos Biológicos', 'url'=>array('/MedicamentosBiologicos/admin')), 
                                array('label'=>'Diagnosticos', 'url'=>array('/Diagnosticos/admin')),
                                array('label'=>'Promociones', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                                'items' => array(
                                    array('label'=>'Activas', 'url'=>array("/Promociones/activas")),
                                    array('label'=>'Vencidas', 'url'=>array("/Promociones/vencidas")),
                                    array('label'=>'Crear', 'url'=>array("/Promociones/create")),
                                    array('label'=>'Listado', 'url'=>array("/Promociones/admin")),
                                    //array('label'=>'Listar Compras', 'url'=>array('/ProductoCompras/admin')),

                                    )), 
                                array('label'=>'Correos', 'url' => '#', 'itemOptions' =>   array('class' => 'dropdown-submenu'),
                                'items' => array(
                                    array('label'=>'Confirmación de Cita', 'url'=>array("/Correos/update&id=1")),
                                    //array('label'=>'Listar Compras', 'url'=>array('/ProductoCompras/admin')),

                                    )), 
                         )),

                        // /*array('label'=>'Seguimiento',  'url'=>array('/noticia')),*/
                        // array('label'=>'Mantenimiento <span class="caret"></span>', 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        // 'items'=>array(
                        //         array('label'=>'Habitaciones', 'url'=>array('/habitacion')),
                        //         array('label'=>'Tipos de Habitación', 'url'=>array('/tipoHabitacion')),
                        //         array('label'=>'Acompañantes', 'url'=>array('/acompanante')),
                        //         array('label'=>'Tipo de Producto', 'url'=>array('/tipoProducto')),
                        //         array('label'=>'Productos', 'url'=>array('/producto')),
                        //         array('label'=>'Facturas', 'url'=>array('/factura')),
                        //         /*array('label'=>'Usuarios', 'url'=>array('/usuario'), 'visible'=> !Yii::app()->user->isGuest and Yii::app()->user->cargo == "Administrador"),*/
                                                       
                        // )),
                        // array('label'=>'Reportes', 'url'=>array('/reportes/index'), 'visible'=>!Yii::app()->user->isGuest),
/*
                        array('label'=>'Gestión <span class="caret"></span>', 'url'=>array('/site/page', 'view'=>'reportes'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'Usuarios', 'url'=>array('/usuario')),
                            array('label'=>'Proyectos Tipos', 'url'=>array('/tipoProyecto')),
                            array('label'=>'Inmuebles Tipos', 'url'=>array('/')),
                            array('label'=>'Inmuebles Estados', 'url'=>array('/estadoInmueble')),
                            array('label'=>'Inmuebles Familias', 'url'=>array('/familia')),
                            array('label'=>'Inmuebles Subfamilias', 'url'=>array('/Subfamilia')),
                            array('label'=>'Códigos Postales', 'url'=>array('/codigoPostal')),
                            array('label'=>'Zonas', 'url'=>array('/zona')),
                        )),
                        */
						//array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),
                        //array('label'=>'Fuentes', 'url'=>array('/site/page', 'view'=>'typography')),
                        /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
                        /*array('label'=>'Mi Cuenta <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'My Messages <span class="badge badge-warning pull-right">26</span>', 'url'=>'#'),
							array('label'=>'My Tasks <span class="badge badge-important pull-right">112</span>', 'url'=>'#'),
							array('label'=>'My Invoices <span class="badge badge-info pull-right">12</span>', 'url'=>'#'),
							array('label'=>'Separated link', 'url'=>'#'),
							array('label'=>'One more separated link', 'url'=>'#'),
                        )),*/
                        array('label'=>'Ingresar', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Cerrar ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); 
                }
                ?>
    	</div>
    </div>
	</div>
</div>