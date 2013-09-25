<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* - __get()
* - __set()
* Classes list:
* - TrackingEventSelectPanelBase extends MJaxPanel
*/
class TrackingEventSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedTrackingEvents = array();
    public $txtSearch = null;
    //public $tblTrackingEvents = null;
    public $intIdTrackingEvent = null;
    public $strName = null;
    public $strValue = null;
    public $intIdUser = null;
    public $intIdSession = null;
    public $intIdApplication = null;
    public $strApp = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=TrackingEvent';
        $this->txtSearch->Name = 'idTrackingEvent';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdTrackingEvent = new MJaxTextBox($this);
        $this->intIdTrackingEvent->Attr('placeholder', " Tracking Event");
        $this->strName = new MJaxTextBox($this);
        $this->strName->Attr('placeholder', " Name");
        $this->strValue = new MJaxTextBox($this);
        $this->strValue->Attr('placeholder', " Value");
        $this->intIdUser = new MJaxTextBox($this);
        $this->intIdUser->Attr('placeholder', " User");
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', " Session");
        $this->intIdApplication = new MJaxTextBox($this);
        $this->intIdApplication->Attr('placeholder', " Application");
        $this->strApp = new MJaxTextBox($this);
        $this->strApp->Attr('placeholder', " App");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedTrackingEvents = array();
            return;
        }
        try {
            if (class_exists($arrParts[0])) {
                $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
            }
        }
        catch(Exception $e) {
            error_log($e->getMessage());
        }
        $arrTrackingEvents = array();
        if (is_null($objEntity)) {
            return $arrTrackingEvents;
        }
        switch (get_class($objEntity)) {
            case ('TrackingEvent'):
                $arrTrackingEvents = array(
                    $objEntity
                );
            break;
            case ('AuthSession'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrTrackingEvents = TrackingEvent::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedTrackingEvents = $arrTrackingEvents;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strName->GetValue())) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->GetValue());
        }
        if (!is_null($this->strValue->GetValue())) {
            $arrAndConditions[] = sprintf('value LIKE "%s%%"', $this->strValue->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (!is_null($this->intIdApplication->GetValue())) {
            $arrAndConditions[] = sprintf('idApplication LIKE "%s%%"', $this->intIdApplication->GetValue());
        }
        if (!is_null($this->strApp->GetValue())) {
            $arrAndConditions[] = sprintf('app LIKE "%s%%"', $this->strApp->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedTrackingEvents;
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "DisplayAdvOptions":
                return $this->blnDisplayAdvOptions;
            default:
                return parent::__get($strName);
                //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
                
        }
    }
    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "DisplayAdvOptions":
                return $this->blnDisplayAdvOptions = $mixValue;
            default:
                return parent::__set($strName, $mixValue);
                //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
                
        }
    }
}
