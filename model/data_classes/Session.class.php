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
    public function State(){
         if(MLCDateTime::IsGreaterThan($this->StartDate)){
             return FFSSessionState::UPCOMING;
         }else{

             if(MLCDateTime::IsLessThan($this->EndDate)){
                 return FFSSessionState::CLOSED;
             }else{
                 return FFSSessionState::ACTIVE;
             }
         }
    }
    public function IsUpcoming(){
       return ($this->State() == FFSSessionState::UPCOMING);
    }
    public function IsClosed(){
        return ($this->State() == FFSSessionState::CLOSED);
    }
    public function IsActive(){
        return ($this->State() == FFSSessionState::ACTIVE);
    }

}


?>