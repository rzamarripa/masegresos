<?php
class UploadForm extends CFormModel {
    public $docto;
     
    public function rules() {
        return array(
        	array('docto', 'required','message'=>'Seleccione un documento'),
            array('docto', 'file', 'types' => 'pdf, jpg, jpeg, png, gif'),
            
        );
    }
    
   
}
?>