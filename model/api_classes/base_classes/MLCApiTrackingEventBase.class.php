<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiTrackingEventBase extends MLCApiClassBase
*/
class MLCApiTrackingEventBase extends MLCApiClassBase {
    protected $strClassName = 'TrackingEvent';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objTrackingEvent = TrackingEvent::LoadById($strName);
        } else {
            $objTrackingEvent = null;
        }
        if (!is_null($objTrackingEvent)) {
            return new MLCApiTrackingEventObject($objTrackingEvent);
        } else {
            throw new MLCApiException("No TrackingEvent found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>