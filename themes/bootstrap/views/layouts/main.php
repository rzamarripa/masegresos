<!DOCTYPE html>
<html ng-app="uas_egresos">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="es"/>

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/docs.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/select2.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/datatable.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/zama.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/timeline.css" />
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>

		<?php Yii::app()->bootstrap->register(); ?>
	</head>

	<body>
		<?php
			$items = array();
			$usuarioActual = Usuario::model()->find('usuario=:x',array(':x'=>Yii::app()->user->name));

			if(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Director')
			{
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
							'items'=>array(
											array('label'=>'Inicio','icon'=>'home', 'url'=>array('site/index')),
											array('label'=>'Catálogos', 'icon'=>'globe', 'url'=>array('#'), 'items'=>array(
												array('label'=>'Usuarios', 'url'=>array('usuario/index')),
												'-',
												array('label'=>'Artículos', 'url'=>array('articulo/index')),
												array('label'=>'Ciudades', 'url'=>array('ciudad/index')),
												array('label'=>'Estados', 'url'=>array('estado/index')),
												array('label'=>'Proveedores', 'url'=>array('proveedor/index')),
												array('label'=>'Unidades', 'url'=>array('unidad/index')),
												array('label'=>'Tipos de Usuarios', 'url'=>array('tipoUsuario/index')),
												array('label'=>'Unidades Organizacionales', 'url'=>array('unidadOrganizacional/index')),)
											),
							            array('label'=>'Documentos', 'url'=>array('#'), 'icon'=>'file', 'items'=>array(
							                array('label'=>'Requisiciones', 'url'=>array('requisicion/index')),
							                array('label'=>'Cotizaciones', 'url'=>array('cotizacion/index')),
							                array('label'=>'Órdenes de Compra', 'url'=>array('ordenCompra/index')),
							                array('label'=>'Contrarecibos', 'url'=>array('contrarecibo/index')),
												),
											),
											array('label'=>'Pasivo', 'url'=>array('#'), 'icon'=>'inbox', 'items'=>array(
							                array('label'=>'Pasivo por proveedor', 'url'=>array('contrarecibo/verfacturasproveedor')),
							                array('label'=>'Pasivo general', 'url'=>array('contrarecibo/verpasivogeneral')),
											)),
											array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
										),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Asistente1'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
											array('label'=>'Inicio', 'icon'=>'home', 'url'=>array('site/index')),
											array('label'=>'Documentos', 'icon'=>'globe', 'url'=>array('#'), 'items'=>array(
							                array('label'=>'Requisición', 'url'=>array('requisicion/index')),
							                array('label'=>'Cotizaciones', 'url'=>array('cotizacion/index')),
											)),
		                    array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Asistente2'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
											array('label'=>'Inicio', 'url'=>array('site/index'),'icon'=>'home'),
											array('label'=>'Documentos', 'url'=>array('requisicion/index'), 'icon'=>'file', 'items'=>array(
												array('label'=>'Requisiciones', 'url'=>array('requisicion/index')),
												array('label'=>'Cotizaciones', 'url'=>array('cotizacion/index')),
												array('label'=>'Ordenes compra por filtro', 'url'=>array('ordenCompra/porproveedoryuo')),
											  array('label'=>'Órdenes de Compra', 'url'=>array('ordenCompra/admin')),
											  array('label'=>'Requisición Temporal', 'url'=>array('requisiciontemp/index')),
											  array('label'=>'Paquetes', 'url'=>array('paqueterequisiciones/index')),
											  array('label'=>'Mercancia en Almacén', 'url'=>array('ordenCompra/mercanciaalmacen')),

									),
								),
								array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'OrdenCompra'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			            	array('label'=>'Inicio', 'url'=>array('site/index'),'icon'=>'home'),
								array('label'=>'Documentos', 'url'=>array('requisicion/index'), 'icon'=>'file', 'items'=>array(
									array('label'=>'Cotizaciones', 'url'=>array('requisicion/requisicionesenviadas')),
				                array('label'=>'Órdenes de Compra', 'url'=>array('ordenCompra/admin')),
								),),
								array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Contrarecibo'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                array('label'=>'Inicio', 'url'=>array('site/index'),'icon'=>'home'),
			                array('label'=>'Documentos', 'url'=>array('requisicion/index'), 'icon'=>'file', 'items'=>array(
									array('label'=>'Contrarecibo', 'url'=>array('contrarecibo/index')),
								)),
				            array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Pasivo'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
						'encodeLabel'=>false,
			            'items'=>array(
							array('label'=>'Inicio', 'url'=>array('site/index'),'icon'=>'home'),
							array('label'=>'Pasivo', 'url'=>array('#'), 'icon'=>'inbox', 'items'=>array(
			                array('label'=>'Pasivo por proveedor', 'url'=>array('contrarecibo/verfacturasproveedor')),
			                array('label'=>'Pasivo general', 'url'=>array('contrarecibo/verpasivogeneral')),
							)),
							array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Almacen'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                array('label'=>'Inicio', 'url'=>array('site/index'), 'icon'=>'file'),
			                array('label'=>'Reportes', 'url'=>array('#'), 'icon'=>'file', 'items'=>array(
								       array('label'=>'Diario Existencia', 'url'=>array('ordenCompra/imprimirA')),
								       array('label'=>'Diario de Salidas Realizadas', 'url'=>array('ordenCompra/imprimirB')),
										 array('label'=>'Órdenes de Compra Pendientes de Surtir', 'url'=> array('OrdenCompra/imprimirC'),'linkOptions'=>array("target" => "_blank")),
								       ),
								),
			                array('label'=>'Contacto','icon'=>'comment', 'url'=>array('site/contact')),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Inventario'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                array('label'=>'Inicio', 'url'=>array('site/index'), 'icon'=>'file'),
								 array('label'=>'Reportes', 'url'=>array('#'), 'icon'=>'file', 'items'=>array(
									       array('label'=>'Imprimir Resguardo', 'url'=>array('inventario/imprimir')),
									       array('label'=>'Imprimir Resguardo Baja', 'url'=>array('inventario/imprimirBaja')),
									       array('label'=>'Imprimir Listado Inv.', 'url'=>array('inventario/imprimirListado')),
									       array('label'=>'Imprimir Listado Inv. Baja', 'url'=>array('inventario/imprimirListadoBaja')),
										),
								),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Proveedor'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                array('label'=>'Inicio', 'url'=>array('site/index'), 'icon'=>'file'),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Proyecto'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                	array('label'=>'Inicio', 'url'=>array('inventario/index'), 'icon'=>'file'),
									array('label'=>'Reportes', 'url'=>array('#'), 'icon'=>'file', 'items'=>array(
									       array('label'=>'Imprimir Resguardo', 'url'=>array('inventario/imprimir')),
									       array('label'=>'Imprimir Resguardo Baja', 'url'=>array('inventario/imprimirBaja')),
									       array('label'=>'Imprimir Listado Inv.', 'url'=>array('inventario/imprimirListado')),
									       array('label'=>'Imprimir Listado Inv. Baja', 'url'=>array('inventario/imprimirListadoBaja')),
										),
									),
			            ),
			        ),
			     );
			}
			elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Invitado'){
				$items=array(
			        array(
			            'class'=>'bootstrap.widgets.TbMenu',
			            'items'=>array(
			                //array('label'=>'Inicio', 'url'=>array('inventario/index'), 'icon'=>'file'),
			            ),
			        ),
			     );
			}

			$items[]=array(
			  'class'=>'bootstrap.widgets.TbMenu',
			  'htmlOptions'=>array('class'=>'pull-right'),
			  'encodeLabel'=>false,
			  'items'=>array(
			  	array('label'=>$usuarioActual->usuario, 'url'=>array('/perfil/view'), 'visible'=>!Yii::app()->user->isGuest, 				'htmlOptions'=>array('class'=>'btn'), 'icon'=>'user','items'=>array(
                array('label'=>'Cambiar contraseña', 'icon'=>'wrench','url'=> array('usuario/cambiar', 'id'=>$usuarioActual->id)),
                array('label'=>'Iniciar Sesión', 'icon'=>'off', 'url'=> array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'htmlOptions'=> array('class'=>'btn')),
					 array('label'=>'<span id="reiniciar">Cerrar Sesión</span>', 'icon'=>'off', 'url'=> array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'htmlOptions'=> array('class'=>'btn'))
            )),
			  ),
			);
			$this->widget('bootstrap.widgets.TbNavbar', array(
			    'type'=>'', // null or 'inverse'
			    'brand'=>Yii::app()->name,
			    'brandUrl'=>array('site/index'),
			    'brandOptions'=>array('class'=>'left'),
			    'collapse'=>true,
			    'items'=>$items
			));

			$flashMessages = Yii::app()->user->getFlashes();
			if($flashMessages){
				foreach($flashMessages as $key => $message){
					echo '<div class="info alert alert-'.$key.'" style="text-align:center">
								<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo '<p>' . $message . '</p>';
					echo '</div>';
				}
			}
		?>
		<div class="container" id="page">
			<div class="row">
				<div class="span12">
					<?php echo $content; ?>
				</div>
			</div>
			<div style="height:15px;"></div>
			<div class="row">
				<div class="span12">
					<div id="footer" style="text-align:center" class="container">
						<strong>Todos los derechos reservados para Universidad Autónoma de Sinaloa <?php echo date('Y'); ?><br/></strong><br/>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/googleapi.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.formatCurrency.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/angular.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/datatable.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/uiselect2.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/first.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/controllers/requisicion.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/controllers/cotizacion.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/controllers/contrarecibo.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/controllers/inventario.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/highcharts.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/highcharts-more.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/highcharts-exporting.js"></script>
	</body>
</html>
<?php
	Yii::app()->clientScript->registerScript(
		'myHideEffect',
		'$(".info").animate({opacity:1.0},5000).slideUp("slow");',
		CClientScript::POS_READY
	);

	Yii::app()->clientScript->registerScript(
		'limpiaretiquetas',
		'$("#reiniciar").click(function()
			{
				localStorage.setItem("ultimoContenidoCotizacionProveedor", "");
				localStorage.setItem("ultimoContenidoProveedorDashboard", "");
				localStorage.setItem("ultimoContenidoRequisicion", "");
				localStorage.setItem("ultimoContenidoCotizacion", "");
				localStorage.setItem("ultimoContenidoProyecto", "");
				localStorage.setItem("ultimoContenidoOrdenCompra", "");
			});',
		CClientScript::POS_READY
	);

	Yii::app()->clientScript->registerScript(
		'tablas',
		'$("#table").DataTable();',
		CClientScript::POS_READY
	);

	Yii::app()->clientScript->registerScript(
		'select2',
		'$(".select2").select2();',
		CClientScript::POS_READY
	);
?>
<script type="text/javascript">
	function limpiaretiquetas(){
		localStorage.clear();
	}

</script>
