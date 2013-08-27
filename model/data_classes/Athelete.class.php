<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/AtheleteBase.class.php");
class Athelete extends AtheleteBase {
    public function __toString(){
        return $this->LastName . ', ' . $this->FirstName;
    }

}


?>