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
* - SessionSelectPanelBase extends MJaxPanel
*/
class SessionSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedSessions = array();
    public $txtSearch = null;
    //public $tblSessions = null;
    public $intIdSession = null;
    public $txtStartDate_StartDate = null;
    public $txtStartDate_EndDate = null;
    public $txtEndDate_StartDate = null;
    public $txtEndDate_EndDate = null;
    public $intIdCompetition = null;
    public $strName = null;
    public $strNotes = null;
    public $strData = null;
    public $strEquipmentSet = null;
    public $strEventData = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, '/data/search?mjax-route-ext=Session');
        $this->txtSearch->Name = 'idSession';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', " Session");
        $this->txtStartDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_StartDate->DateOnly();
        $this->txtStartDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_EndDate->DateOnly();
        $this->txtEndDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_StartDate->DateOnly();
        $this->txtEndDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_EndDate->DateOnly();
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->intIdCompetition->Attr('placeholder', " Competition");
        $this->strName = new MJaxTextBox($this);
        $this->strName->Attr('placeholder', " Name");
        $this->strNotes = new MJaxTextBox($this);
        $this->strNotes->Attr('placeholder', " Notes");
        $this->strData = new MJaxTextBox($this);
        $this->strData->Attr('placeholder', " Data");
        $this->strEquipmentSet = new MJaxTextBox($this);
        $this->strEquipmentSet->Attr('placeholder', " Equipment Set");
        $this->strEventData = new MJaxTextBox($this);
        $this->strEventData->Attr('placeholder', " Event Data");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedSessions = array();
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
        $arrSessions = array();
        if (is_null($objEntity)) {
            return $arrSessions;
        }
        switch (get_class($objEntity)) {
            case ('Session'):
                $arrSessions = array(
                    $objEntity
                );
            break;
            case ('Competition'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idCompetition = %s', $objEntity->IdCompetition);
                $arrSessions = Session::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedSessions = $arrSessions;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        //Is special field!!!!!
        if (!is_null($this->txtStartDate_StartDate->GetValue())) {
            if (is_null($this->txtStartDate_EndDate->GetValue())) {
                $this->txtStartDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(startDate > "%s" AND startDate < "%s")', $this->txtStartDate_StartDate->GetValue() , $this->txtStartDate_EndDate->GetValue());
            }
        }
        //Is special field!!!!!
        if (!is_null($this->txtEndDate_StartDate->GetValue())) {
            if (is_null($this->txtEndDate_EndDate->GetValue())) {
                $this->txtEndDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(endDate > "%s" AND endDate < "%s")', $this->txtEndDate_StartDate->GetValue() , $this->txtEndDate_EndDate->GetValue());
            }
        }
        if (!is_null($this->strName->GetValue())) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->GetValue());
        }
        if (!is_null($this->strNotes->GetValue())) {
            $arrAndConditions[] = sprintf('notes LIKE "%s%%"', $this->strNotes->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->strEquipmentSet->GetValue())) {
            $arrAndConditions[] = sprintf('equipmentSet LIKE "%s%%"', $this->strEquipmentSet->GetValue());
        }
        //Is special field!!!!!
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedSessions;
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
