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
* - AtheleteSelectPanelBase extends MJaxPanel
*/
class AtheleteSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedAtheletes = array();
    public $txtSearch = null;
    //public $tblAtheletes = null;
    public $intIdAthelete = null;
    public $intIdOrg = null;
    public $strFirstName = null;
    public $strLastName = null;
    public $txtBirthDate_StartDate = null;
    public $txtBirthDate_EndDate = null;
    public $strMemType = null;
    public $strMemId = null;
    public $strPsData = null;
    public $strLevel = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchAthelete');
        $this->txtSearch->Name = 'idAthelete';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdAthelete->Attr('placeholder', " Athelete");
        $this->intIdOrg = new MJaxTextBox($this);
        $this->intIdOrg->Attr('placeholder', " Org");
        $this->strFirstName = new MJaxTextBox($this);
        $this->strFirstName->Attr('placeholder', " First Name");
        $this->strLastName = new MJaxTextBox($this);
        $this->strLastName->Attr('placeholder', " Last Name");
        $this->txtBirthDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtBirthDate_StartDate->DateOnly();
        $this->txtBirthDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtBirthDate_EndDate->DateOnly();
        $this->strMemType = new MJaxTextBox($this);
        $this->strMemType->Attr('placeholder', " Mem Type");
        $this->strMemId = new MJaxTextBox($this);
        $this->strMemId->Attr('placeholder', " Mem Id");
        $this->strPsData = new MJaxTextBox($this);
        $this->strPsData->Attr('placeholder', " Ps Data");
        $this->strLevel = new MJaxTextBox($this);
        $this->strLevel->Attr('placeholder', " Level");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedAtheletes = array();
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
        $arrAtheletes = array();
        if (is_null($objEntity)) {
            return $arrAtheletes;
        }
        switch (get_class($objEntity)) {
            case ('Athelete'):
                $arrAtheletes = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrAtheletes = Athelete::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedAtheletes = $arrAtheletes;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strFirstName->GetValue())) {
            $arrAndConditions[] = sprintf('firstName LIKE "%s%%"', $this->strFirstName->GetValue());
        }
        if (!is_null($this->strLastName->GetValue())) {
            $arrAndConditions[] = sprintf('lastName LIKE "%s%%"', $this->strLastName->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->txtBirthDate_StartDate->GetValue())) {
            if (is_null($this->txtBirthDate_EndDate->GetValue())) {
                $this->txtBirthDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(birthDate > "%s" AND birthDate < "%s")', $this->txtBirthDate_StartDate->GetValue() , $this->txtBirthDate_EndDate->GetValue());
            }
        }
        if (!is_null($this->strMemType->GetValue())) {
            $arrAndConditions[] = sprintf('memType LIKE "%s%%"', $this->strMemType->GetValue());
        }
        if (!is_null($this->strMemId->GetValue())) {
            $arrAndConditions[] = sprintf('memId LIKE "%s%%"', $this->strMemId->GetValue());
        }
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strLevel->GetValue())) {
            $arrAndConditions[] = sprintf('level LIKE "%s%%"', $this->strLevel->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedAtheletes;
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
