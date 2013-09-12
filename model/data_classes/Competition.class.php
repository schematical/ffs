<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/CompetitionBase.class.php");

class Competition extends CompetitionBase {

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