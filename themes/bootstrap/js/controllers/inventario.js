function InventarioController($scope) {
  
	window.scope = $scope;
    	 
	 var empty_detalle = {   		
		articulo_aid : "",
		articulo_descripcion: "",
		uo_did : "",
		uo_descripcion: "",
		espacio_aid : "",
		espacio_descripcion : "",
		marca_aid: "",
		marca_descripcion: "",
		modelo: "",
		serie : "",
		costoAdquisicion :"",
		iva: "",
		totalCostoAdquisicion :"",
		porcentajeIva: "",
		observaciones: "",
		cantidad : "",
		lote : "",
		cantidadPorLote : "",
		tipo: ""
	 }


	$scope.inventarios = [];
	$scope.detalle = angular.copy(empty_detalle);

	
	$scope.agregar = function () {

		if($scope.validar() == false)
			return;
		
		var itemDetalle = angular.copy(empty_detalle);

		$valorIva = $("#valorIva").val();
		
		itemDetalle.articulo_aid = $('#DetalleInventario_articulo_aid').select2('data').id;
		itemDetalle.articulo_descripcion = $('#DetalleInventario_articulo_aid').select2('data').text;
		itemDetalle.uo_did = $('#DetalleInventario_unidadOrganizacional_did').select2('data').id;
		itemDetalle.uo_descripcion = $('#DetalleInventario_unidadOrganizacional_did').select2('data').text;
		itemDetalle.espacio_aid = $('#DetalleInventario_funcion_aid').select2('data').id;
		itemDetalle.espacio_descripcion = $('#DetalleInventario_funcion_aid').select2('data').text;
		itemDetalle.marca_aid = $('#DetalleInventario_marca_aid').select2('data').id;
		itemDetalle.marca_descripcion = $('#DetalleInventario_marca_aid').select2('data').text;
		itemDetalle.modelo = $scope.detalle.modelo;		
		itemDetalle.serie = $scope.detalle.serie;
		$costoAdquisicion = $scope.detalle.costoAdquisicion;
		itemDetalle.costoAdquisicion = Math.round($costoAdquisicion * 100) / 100;
		$iva = itemDetalle.costoAdquisicion * ($valorIva/100);
		itemDetalle.iva = Math.round($iva * 100) / 100;
		$totalCosto = itemDetalle.costoAdquisicion + itemDetalle.iva;
		itemDetalle.totalCostoAdquisicion = Math.round($totalCosto * 100) / 100;
		itemDetalle.porcentajeIva = $valorIva;
		itemDetalle.observaciones = $scope.detalle.observaciones;
		itemDetalle.cantidad = $scope.detalle.cantidad;				
		itemDetalle.lote = $scope.detalle.lote;
		itemDetalle.cantidadPorLote = $scope.detalle.cantidadPorLote;
		
		if($("#Inventario_tipoCaptura_0").attr("class") == "btn btn-primary active"){
			itemDetalle.tipo = "Normal";
		}else if($("#Inventario_tipoCaptura_1").attr("class") == "btn btn-primary active"){
			itemDetalle.tipo = "Multiple";
		}else{
			itemDetalle.tipo = "Lote";
		}
		
		$scope.inventarios.push(itemDetalle);
		$nuevo = angular.copy(empty_detalle);
		
		if($scope.articulo == true){
			$('#DetalleInventario_articulo_aid').select2('data').id = itemDetalle.articulo_aid;
			$('#DetalleInventario_articulo_aid').select2('data').text = itemDetalle.articulo_descripcion;
			$nuevo.articulo_aid = itemDetalle.articulo_aid;
		}else{
			$('#DetalleInventario_articulo_aid').select2('data').id = "";
			$('#DetalleInventario_articulo_aid').select2('data').text = "";
			$("#s2id_DetalleInventario_articulo_aid span.select2-chosen").text("");
		}
		if($scope.uo == true){
			$('#DetalleInventario_unidadOrganizacional_did').select2('data').id = itemDetalle.uo_did;
			$('#DetalleInventario_unidadOrganizacional_did').select2('data').text = itemDetalle.uo_descripcion;
			$nuevo.uo_did = itemDetalle.uo_did;
		}else{
			$('#DetalleInventario_unidadOrganizacional_did').select2('data').id = "";
			$('#DetalleInventario_unidadOrganizacional_did').select2('data').text = "";
			$("#s2id_DetalleInventario_unidadOrganizacional_did span.select2-chosen").text("");
		}
		if($scope.espacio == true){
			$('#DetalleInventario_funcion_aid').select2('data').id = itemDetalle.espacio_aid;
			$('#DetalleInventario_funcion_aid').select2('data').text = itemDetalle.espacio_descripcion;
			$nuevo.espacio_aid = itemDetalle.espacio_aid;
		}else{
			$('#DetalleInventario_funcion_aid').select2('data').id = "";
			$('#DetalleInventario_funcion_aid').select2('data').text = "";
			$("#s2id_DetalleInventario_funcion_aid span.select2-chosen").text("");
		}
		if($scope.marcas == true){
			$('#DetalleInventario_marca_aid').select2('data').id = itemDetalle.marca_aid;
			$('#DetalleInventario_marca_aid').select2('data').text = itemDetalle.marca_descripcion;
			$nuevo.marca_aid = itemDetalle.marca_aid;
		}else{
			$('#DetalleInventario_marca_aid').select2('data').id = "";
			$('#DetalleInventario_marca_aid').select2('data').text = "";
			$("#s2id_DetalleInventario_marca_aid span.select2-chosen").text("");
		}
		if($scope.modelo == true){
			$nuevo.modelo = itemDetalle.modelo;
		}
		if($scope.costo == true){
			$nuevo.costoAdquisicion = itemDetalle.costoAdquisicion;
		}
		if($scope.observaciones == true){
			$nuevo.observaciones = itemDetalle.observaciones;
		}
		
		$scope.detalle = $nuevo;
	}
	
	$scope.validar = function(){
		var error = false;
		
		if($("#Inventario_tipoCaptura_1").attr("class") == "btn btn-primary active"){
			if(isNaN(parseInt($scope.detalle.cantidad)) || $scope.detalle.cantidad <= 0 || $scope.detalle.cantidad == ""){
				$scope.errorCantidad = true;
				error = true;
			}else{
				$scope.errorCantidad = false;
			}
		}

		if($("#Inventario_tipoCaptura_2").attr("class") == "btn btn-primary active"){			
			if(isNaN(parseInt($scope.detalle.cantidadPorLote)) || $scope.detalle.cantidadPorLote <= 0 || $scope.detalle.cantidadPorLote == ""){
				$scope.errorCantLote = true;
				error = true;
			}else{
				$scope.errorCantLote = false;
			}
		}

		if($("#DetalleInventario_articulo_aid").select2('data').text == ""){
			$scope.errorArticulo = true;
			error = true;
		}else{
			$scope.errorArticulo = false;
		}
		if($("#DetalleInventario_unidadOrganizacional_did").select2('data').text == ""){
			$scope.errorUo = true;
			error = true;
		}else{
			$scope.errorUo = false;
		}
		if($('#DetalleInventario_funcion_aid').select2('data').text == ""){
			$scope.errorEspacio = true;
			error = true;
		}else{
			$scope.errorEspacio = false;
		}
		if($("#DetalleInventario_marca_aid").select2('data').text == ""){
			$scope.errorMarca = true;
			error = true;
		}else{
			$scope.errorMarca = false	;
		}
		if(isNaN(parseInt($scope.detalle.costoAdquisicion)) || $scope.detalle.costoAdquisicion <= 0 || $scope.detalle.costoAdquisicion == ""){
			$scope.errorCosto = true;
			error = true;
		}else{
			$scope.errorCosto = false;
		}
		

		return !error;
	}
	
	$scope.validaCantidad = function() {
     alert($scope);
   };

		
	$scope.cancelar = function (item, e) {
		e.preventDefault();
		var c = confirm('¿Está seguro de remover este artículo?');
		if (!c) return;
		var i = $scope.inventarios.indexOf(item);
		if (i >= 0) $scope.inventarios.splice(i, 1);
	}	
};


