<div class="row">
	<div class="span12">
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		  	<ul class="nav nav-tabs">
		    	<li class="active"><a href="#tab1" data-toggle="tab"></i> Normal</a></li>
				<li><a href="#tab2" data-toggle="tab"></i> Múltiple</a></li>		
				<li><a href="#tab3" data-toggle="tab"></i> Lote</a></li>
			</ul>
			<div class="tab-content">
		    	<div class="tab-pane active" id="tab1">
					<?php $this->renderPartial("_inventarioNormal",array('inventariosNormales'=>$inventariosNormales)); ?>
				</div>
				<div class="tab-pane" id="tab2">
					<?php $this->renderPartial("_inventarioMultiple",array('inventario'=>$inventario, 'inventariosMultiples'=>$inventariosMultiples, 'modelDetalle'=>$modelDetalle)); ?>
				</div>
				<div class="tab-pane" id="tab3">
					<?php $this->renderPartial("_inventarioLote",array('inventariosLotes'=>$inventariosLotes, 'modelDetalle'=>$modelDetalle)); ?>
				</div>
			</div>
		</div>
	</div>
</div>