<?php    
    $tipoUsuarioActual = Usuario::model()->obtenerTipoUsuarioActual();

    if(isset($tipoUsuarioActual) && $tipoUsuarioActual == 'Director'){
            $this->renderPartial("_directorIndex");
    } 
    elseif(	isset($tipoUsuarioActual) && $tipoUsuarioActual == 'Asistente2' || 
    			isset($tipoUsuarioActual) && $tipoUsuarioActual == 'OrdenCompra' ||
    			isset($tipoUsuarioActual) && $tipoUsuarioActual == 'Pasivo'){
        $this->renderPartial("_asistenteIndex");
    }
?> 