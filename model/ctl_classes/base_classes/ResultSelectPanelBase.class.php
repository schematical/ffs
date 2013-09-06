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
* - ResultSelectPanelBase extends MJaxPanel
*/
class ResultSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedResults = array();
    public $txtSearch = null;
    //public $tblResults = null;
    public $intIdResult = null;
    public $intIdSession = null;
    public $intIdAthelete = null;
    public $strScore = null;
    public $strJudge = null;
    public $intFlag = null;
    public $strEvent = null;
    public $txtDispDate_StartDate = null;
    public $txtDispDate_EndDate = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=Result';
        $this->txtSearch->Name = 'idResult';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdResult = new MJaxTextBox($this);
        $this->intIdResult->Attr('placeholder', " Result");
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', " Session");
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdAthelete->Attr('placeholder', " Athelete");
        $this->strScore = new MJaxTextBox($this);
        $this->strScore->Attr('placeholder', " Score");
        $this->strJudge = new MJaxTextBox($this);
        $this->strJudge->Attr('placeholder', " Judge");
        $this->intFlag = new MJaxTextBox($this);
        $this->intFlag->Attr('placeholder', " Flag");
        $this->strEvent = new MJaxTextBox($this);
        $this->strEvent->Attr('placeholder', " Event");
        $this->txtDispDate_StartDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_StartDate->DateOnly();
        $this->txtDispDate_EndDate = new MJaxBSDateTimePicker($this);
        $this->txtDispDate_EndDate->DateOnly();
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedResults = array();
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
        $arrResults = array();
        if (is_null($objEntity)) {
            return $arrResults;
        }
        switch (get_class($objEntity)) {
            case ('Result'):
                $arrResults = array(
                    $objEntity
                );
            break;
            case ('Session'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrResults = Result::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Athelete'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idAthelete = %s', $objEntity->IdAthelete);
                $arrResults = Result::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedResults = $arrResults;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strScore->GetValue())) {
            $arrAndConditions[] = sprintf('score LIKE "%s%%"', $this->strScore->GetValue());
        }
        if (!is_null($this->strJudge->GetValue())) {
            $arrAndConditions[] = sprintf('judge LIKE "%s%%"', $this->strJudge->GetValue());
        }
        if (!is_null($this->intFlag->GetValue())) {
            $arrAndConditions[] = sprintf('flag LIKE "%s%%"', $this->intFlag->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strEvent->GetValue())) {
            $arrAndConditions[] = sprintf('event LIKE "%s%%"', $this->strEvent->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->txtDispDate_StartDate->GetValue())) {
            if (is_null($this->txtDispDate_EndDate->GetValue())) {
                $this->txtDispDate_StartDate->Alert("Must have an end date to perform this function");
            } else {
                $arrAndConditions[] = sprintf('(dispDate > "%s" AND dispDate < "%s")', $this->txtDispDate_StartDate->GetValue() , $this->txtDispDate_EndDate->GetValue());
            }
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedResults;
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
