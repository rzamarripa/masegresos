<?php
    $this->pageCaption='Realizar Cotización';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='';
?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1">Cantidad Requerida</td>
					<td class="span1">Nombre Articulo</td>
					<td class="span1">Cantidad A Proveer</td>
					<td class="span2">Precio Unitario</td>
				</tr>
			</thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="span3">
        <table class="table table-striped table-bordered table-hover table-condensed pull-right">
            <tr>
                <td class="span1">Subtotal</td>
                <td class="span1"></td>

            </tr>
            <tr>
                <td class="span1">Iva</td>
                <td class="span1"></td>
            </tr>
            <tr>
                <td class="span1">Total</td>
                <td class="span1"></td>
            </tr>
        </table>
    </div>
</div>