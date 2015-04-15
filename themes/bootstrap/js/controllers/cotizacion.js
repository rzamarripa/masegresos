app.controller('CotizacionController', ['$scope', function ($scope) {
	window.scope = $scope;
 
	$scope.requisicion = window.first.data.requisicion;
	$scope.totales = {
		subtotal: 0.00,
		iva: 0.00,
		total: 0.00
	}

	if (window.first.data.detalle_cotizacion) {
		$scope.items = window.first.data.detalle_cotizacion;
	} else {
		$scope.items = $scope.requisicion.detalle;
	}

	angular.forEach($scope.items, function (item) {
		item.error = {
			cantidad: false,
			precio: false
		}		
	})

	$scope.calcularTotal = function (item) {
		item.importe = (item.precio * item.cantidad).toFixed(2);
		$scope.calcularTotales();
	}

	$scope.calcularTotales = function () {
		var subtotal = 0.00;
		angular.forEach($scope.items, function (item) {
			if (!item.importe) return;
			subtotal += parseFloat(item.importe);
		});
		iva = subtotal * 0.16;
		total = parseFloat(subtotal) + parseFloat(iva);
		$scope.totales.subtotal = subtotal.toFixed(2);
		$scope.totales.iva = iva.toFixed(2);
		$scope.totales.total = total.toFixed(2);
	}

	window.validarCotizacion = function (form) {
		var error = false;
		angular.forEach($scope.items, function (item) {
			item.error.cantidad = false;
			item.error.precio = false;
			if (isNaN(parseInt(item.cantidad)) || item.cantidad == '' || item.cantidad <= 0) {
				error = true;
				item.error.cantidad = true;
			}
			if (item.precio == undefined || item.precio == '' || isNaN(parseFloat(item.precio)) || item.precio <= 0) {
				error = true;
				item.error.precio = true;
			}
		});
		//if (error) e.preventDefault();
		$scope.$apply();
		
		return !error;
	}

	//validarCotizacion = $scope.validarCotizacion;

	if (window.first.data.detalle_cotizacion) {
		$scope.calcularTotales();
	}
}]);
$(document).ready(function() { 
		$(".select2minimun4").select2({
			minimumInputLength: 4,
		});
		$(".select2minimun2").select2({
			minimumInputLength: 2,
		});
		$(".select2").select2(); 
});