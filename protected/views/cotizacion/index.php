<?php
    $usuarioActual = Usuario::model()->find('usuario=:x',array(':x'=>Yii::app()->user->name));
    if(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Asistente1' || isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Asistente2'){
        $this->renderPartial("_capturistaIndex");
    } else {
        $this->renderPartial("_directorIndex");
    }
?> 