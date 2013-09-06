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
* - AssignmentSelectPanelBase extends MJaxPanel
*/
class AssignmentSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedAssignments = array();
    public $txtSearch = null;
    //public $tblAssignments = null;
    public $intIdAssignment = null;
    public $intIdDevice = null;
    public $intIdSession = null;
    public $strEvent = null;
    public $strApartatus = null;
    public $intIdUser = null;
    public $txtRevokeDate_StartDate = null;
    public $txtRevokeDate_EndDate = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=Assignment';
        $this->txtSearch->Name = 'idAssignment';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdAssignment = new MJaxTextBox($this);
        $this->intIdAssignment->Attr('placeholder', " Assignment");
        $this->intIdDevice = new MJaxTextBox($this);
        $this->intIdDevice->Attr('placeholder', " Device");
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', " Session");
        $this->strEvent = new MJaxTextBox($this);
        $this->strEvent->Attr('placeholder', " Event");
        $this->strApartatus = new MJaxTextBox($this);
        $this->strApartatus->Attr('placeholder', " Apartatus");
        $this->intIdUser = new MJaxTextBox($this);
        $this->intIdUser->Attr('placeholder', " User");
        $this->txtRevokeDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtRevokeDate_StartDate->DateOnly();
        $this->txtRevokeDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtRevokeDate_EndDate->DateOnly();
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedAssignments = array();
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
        $arrAssignments = array();
        if (is_null($objEntity)) {
            return $arrAssignments;
        }
        switch (get_class($objEntity)) {
            case ('Assignment'):
                $arrAssignments = array(
                    $objEntity
                );
            break;
            case ('Device'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idDevice = %s', $objEntity->IdDevice);
                $arrAssignments = Assignment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Session'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrAssignments = Assignment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedAssignments = $arrAssignments;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strEvent->GetValue())) {
            $arrAndConditions[] = sprintf('event LIKE "%s%%"', $this->strEvent->GetValue());
        }
        if (!is_null($this->strApartatus->GetValue())) {
            $arrAndConditions[] = sprintf('apartatus LIKE "%s%%"', $this->strApartatus->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        //Is special field!!!!!
        if (!is_null($this->txtRevokeDate_StartDate->GetValue())) {
            if (is_null($this->txtRevokeDate_EndDate->GetValue())) {
                $this->txtRevokeDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(revokeDate > "%s" AND revokeDate < "%s")', $this->txtRevokeDate_StartDate->GetValue() , $this->txtRevokeDate_EndDate->GetValue());
            }
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedAssignments;
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
