<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/SessionBase.class.php");
class Session extends SessionBase {

    public function Events($arrEventData = null){
        if(is_null($arrEventData)){
            if(strlen($this->arrDBFields['eventData']) < 1){
                return array();
            }
            return json_decode($this->arrDBFields['eventData'], true);
        }else{
            $this->arrDBFields['eventData'] = json_encode($arrEventData);
            $this->Save();
        }
    }
    public function __toString(){
        return $this->Name;
    }

}


?>