function BajaInventarioController($scope) {

	window.scope = $scope;
    	 
	 var empty_detalle = {   		
		id : "",
		lote: "",
		cantidadLote: "",
		nombre: "",
		uo: "",
		motivoBaja: ""
	 }


	$scope.inventarios = [];
	$scope.detalle = angular.copy(empty_detalle);  
		
	$scope.agregar = function () {


		if($scope.validar() == false)
			return;

		$('#unidadOrganizacional').attr('disabled', 'true');
		$('#uo_did').val($('#unidadOrganizacional').val());

		var busqueda = 0;
		if($("#checkMultiple").is(":checked") == true)
		{
			busqueda = 1;
		}

		$('#btnAgregar').button('loading');
		var parametros = {
				"busqueda" : busqueda,
                "invInicio" : $scope.invInicio,
                "invFin" : $scope.invFin,
                "uo": $('#unidadOrganizacional').val()
        };

		 $.ajax({
                data:  parametros,
                url:   '/inventario/Detallebajainventario',
                type:  'post',
                async: false,
                success:  function (d) {
                	try
                	{
                		obj = JSON.parse(d);

                		if(obj.estatus == 1)
                		{
	                		for (index = 0; index < obj.datos.length; ++index) {
	            				var existe = false;
	                			for (index2 = 0; index2 < $scope.inventarios.length; ++index2) {
									if($scope.inventarios[index2].id == obj.datos[index].id)
									{
										existe = true;
									}
								}
								if(existe == false){
									var itemDetalle = angular.copy(empty_detalle);
			 						itemDetalle.id = obj.datos[index].id;
			 						itemDetalle.lote = obj.datos[index].lote;
			 						itemDetalle.cantidadLote = obj.datos[index].cantidadLote;
			 						itemDetalle.nombre = obj.datos[index].nombre;
			 						itemDetalle.uo = obj.datos[index].uo;
			 						itemDetalle.motivoBaja = $('#motivoBaja').val();
			 						$scope.inventarios.push(itemDetalle);
								}							
							}
						}
						$('#btnAgregar').button('reset');
                	}
                	catch(err)
                	{
                		$('#btnAgregar').button('reset');
                		alert(err.message);
                	}
                },
                error: function(d){
                	$('#btnAgregar').button('reset');
                	alert(d);
                }
        });

	}
	
	$scope.validar = function(){
		var error = false;

		if($('#unidadOrganizacional').val() == ''){
			error = true;
			alert("Debe seleccionar una UO");
		}else{
			error = false;
		}

		if(error == false){
			if(isNaN(parseInt($scope.invInicio)) || $scope.invInicio % 1 != 0){
				$scope.errorInicio = true;
				error = true;
				alert("El valor ingresado debe ser numerico");
			}else{
				error = false;
				$scope.errorInicio = false;
			}
		}

		if($("#checkMultiple").is(":checked"))
		{
			if(isNaN(parseInt($scope.invFin)) || $scope.invFin % 1 != 0){
				$scope.errorFin = true;
				if(error != true)
				{
					alert("El valor ingresado debe ser numerico");
				}
				error = true;
			}else{
				$scope.errorFin = false;
				error = false;
			}

			if(error == false)
			{
				if($scope.invFin < $scope.invInicio)
				{
					$scope.errorInicio = true;
					$scope.errorFin = true;
					alert("El numero de fin no puede ser mayor al numero de inicio");
					error = true;
				}
				else{
					$scope.errorInicio = false;
					$scope.errorFin = false;
					error = false;
				}
			}
		}	

		if(error == false){
			if($('#motivoBaja').val() == ''){
			error = true;
			alert("Debe seleccionar un motivo de baja");
		}else{
			error = false;
		}
		}

		return !error;
	}


	$scope.cancelar = function (item, e) {
		e.preventDefault();
		var c = confirm('¿Está seguro de remover este artículo?');
		if (!c) return;
		var i = $scope.inventarios.indexOf(item);
		if (i >= 0) $scope.inventarios.splice(i, 1);
	}

	$scope.baja = function (item, e) {
		
		if($scope.validarBaja() == false)
			return;

		$("#btnBaja").attr('disabled', 'true');
		$("#inventarioDetalle-form").submit();
	}

	$scope.validarBaja = function(){

		var error = false;
		$(".cantBaja").each(function(){
			var numBaja = $(this).val();
			if(isNaN(parseInt(numBaja)) || numBaja % 1 != 0 || (parseInt(numBaja) <= 0)){
				$(this).addClass("error");
				$(this).focus();
				error = true;
			}
			else{
				$(this).removeClass("error");
				error = false;	
			}
		})

		return !error;
	}

};

$(document).ready(function() {
    $("#checkMultiple").click(function() {
	  if (this.checked) {
	    $("#inventarioA").attr("disabled", false);
	  } else {
	    $("#inventarioA").attr("disabled", true);
	    $("#inventarioA").val('');
	  }
	});	
});

