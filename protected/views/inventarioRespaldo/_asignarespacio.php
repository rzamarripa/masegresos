<div class="row" id="detalleLotes" style="display:none;">
	<div class="colspan8 offset2">
	    <div id="ctrl-exmpl" ng-controller="SettingsController2">
		    <table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Cantidad</th>
						<th>Espacio</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in contacts">
						<td>
			     			<input type="text" ng-model="contact.cantidad"/>
			     		</td>
			     		<td>
			     			<span class="control-group" ng-class="{true: 'error', false: ''}[item.error.articulo]">
								<input style="width:350px;" type="hidden" ui-select2="funcionOptions" 
												name="detalle[{{key}}][funcion]" ng-model="item.funcion" />
							</span>
			     		</td>
			     		<td>
			     			<button ng-click="cancelar(item, $event)" class="btn btn-mini btn-danger">Cancelar</button>
			     		</td>
			     	</tr>
			    </tbody>
			</table>
			<a ng-click="agregar()" href="" class="btn"><i class="icon-plus">&nbsp;</i></a>
		</div>
	</div>
</div>