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
* - CompetitionSelectPanelBase extends MJaxPanel
*/
class CompetitionSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedCompetitions = array();
    public $txtSearch = null;
    //public $tblCompetitions = null;
    public $intIdCompetition = null;
    public $strName = null;
    public $strLongDesc = null;
    public $txtStartDate_StartDate = null;
    public $txtStartDate_EndDate = null;
    public $txtEndDate_StartDate = null;
    public $txtEndDate_EndDate = null;
    public $intIdOrg = null;
    public $strNamespace = null;
    public $txtSignupCutOffDate_StartDate = null;
    public $txtSignupCutOffDate_EndDate = null;
    public $strClubType = null;
    public $strData = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=Competition';
        $this->txtSearch->Name = 'idCompetition';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->intIdCompetition->Attr('placeholder', " Competition");
        $this->strName = new MJaxTextBox($this);
        $this->strName->Attr('placeholder', " Name");
        $this->strLongDesc = new MJaxTextBox($this);
        $this->strLongDesc->Attr('placeholder', " Long Desc");
        $this->txtStartDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_StartDate->DateOnly();
        $this->txtStartDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtStartDate_EndDate->DateOnly();
        $this->txtEndDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_StartDate->DateOnly();
        $this->txtEndDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtEndDate_EndDate->DateOnly();
        $this->intIdOrg = new MJaxTextBox($this);
        $this->intIdOrg->Attr('placeholder', " Org");
        $this->strNamespace = new MJaxTextBox($this);
        $this->strNamespace->Attr('placeholder', " Namespace");
        $this->txtSignupCutOffDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtSignupCutOffDate_StartDate->DateOnly();
        $this->txtSignupCutOffDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtSignupCutOffDate_EndDate->DateOnly();
        $this->strClubType = new MJaxTextBox($this);
        $this->strClubType->Attr('placeholder', " Club Type");
        $this->strData = new MJaxTextBox($this);
        $this->strData->Attr('placeholder', " Data");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedCompetitions = array();
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
        $arrCompetitions = array();
        if (is_null($objEntity)) {
            return $arrCompetitions;
        }
        switch (get_class($objEntity)) {
            case ('Competition'):
                $arrCompetitions = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrCompetitions = Competition::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedCompetitions = $arrCompetitions;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strName->GetValue())) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->GetValue());
        }
        if (!is_null($this->strLongDesc->GetValue())) {
            $arrAndConditions[] = sprintf('longDesc LIKE "%s%%"', $this->strLongDesc->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
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
        if (!is_null($this->strNamespace->GetValue())) {
            $arrAndConditions[] = sprintf('namespace LIKE "%s%%"', $this->strNamespace->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->txtSignupCutOffDate_StartDate->GetValue())) {
            if (is_null($this->txtSignupCutOffDate_EndDate->GetValue())) {
                $this->txtSignupCutOffDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(signupCutOffDate > "%s" AND signupCutOffDate < "%s")', $this->txtSignupCutOffDate_StartDate->GetValue() , $this->txtSignupCutOffDate_EndDate->GetValue());
            }
        }
        if (!is_null($this->strClubType->GetValue())) {
            $arrAndConditions[] = sprintf('clubType LIKE "%s%%"', $this->strClubType->GetValue());
        }
        //Is special field!!!!!
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedCompetitions;
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
