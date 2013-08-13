<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/SessionBase.class.php");
class Session extends SessionBase {

    public function Events($arrEventData = null){
        if(is_null($arrEventData)){
            if(strlen($this->EventData) < 1){
                return array();
            }
            return json_decode($this->EventData, true);
        }else{
            $this->EventData = json_encode($arrEventData);
            $this->Save();
        }
    }

}


?>