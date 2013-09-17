<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/ResultBase.class.php");
class Result extends ResultBase {


    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case "IdInputUser":
                throw new Exception("Cannot set this property");
            default:
                return parent::__set($strName, $mixValue);
            //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }
    public function Save(){
        if(is_null($this->__get('IdInputUser'))){
            $this->arrDBFields['idInputUser'] = MLCAuthDriver::IdUser();
        }
        return parent::Save();
    }

}


?>