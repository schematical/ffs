<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/CompetitionBase.class.php");

class Competition extends CompetitionBase {

    public function __toString(){
        return $this->Name;
    }

}


?>