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
* - EnrollmentSelectPanelBase extends MJaxPanel
*/
class EnrollmentSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedEnrollments = array();
    public $txtSearch = null;
    //public $tblEnrollments = null;
    public $intIdEnrollment = null;
    public $intIdAthelete = null;
    public $intIdCompetition = null;
    public $intIdSession = null;
    public $strFlight = null;
    public $strDivision = null;
    public $strAgeGroup = null;
    public $strMisc1 = null;
    public $strMisc2 = null;
    public $strMisc3 = null;
    public $strMisc4 = null;
    public $strMisc5 = null;
    public $strLevel = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchEnrollment');
        $this->txtSearch->Name = 'idEnrollment';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdEnrollment = new MJaxTextBox($this);
        $this->intIdEnrollment->Attr('placeholder', " Enrollment");
        $this->intIdAthelete = new MJaxTextBox($this);
        $this->intIdAthelete->Attr('placeholder', " Athelete");
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->intIdCompetition->Attr('placeholder', " Competition");
        $this->intIdSession = new MJaxTextBox($this);
        $this->intIdSession->Attr('placeholder', " Session");
        $this->strFlight = new MJaxTextBox($this);
        $this->strFlight->Attr('placeholder', " Flight");
        $this->strDivision = new MJaxTextBox($this);
        $this->strDivision->Attr('placeholder', " Division");
        $this->strAgeGroup = new MJaxTextBox($this);
        $this->strAgeGroup->Attr('placeholder', " Age Group");
        $this->strMisc1 = new MJaxTextBox($this);
        $this->strMisc1->Attr('placeholder', " Misc 1");
        $this->strMisc2 = new MJaxTextBox($this);
        $this->strMisc2->Attr('placeholder', " Misc 2");
        $this->strMisc3 = new MJaxTextBox($this);
        $this->strMisc3->Attr('placeholder', " Misc 3");
        $this->strMisc4 = new MJaxTextBox($this);
        $this->strMisc4->Attr('placeholder', " Misc 4");
        $this->strMisc5 = new MJaxTextBox($this);
        $this->strMisc5->Attr('placeholder', " Misc 5");
        $this->strLevel = new MJaxTextBox($this);
        $this->strLevel->Attr('placeholder', " Level");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedEnrollments = array();
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
        $arrEnrollments = array();
        if (is_null($objEntity)) {
            return $arrEnrollments;
        }
        switch (get_class($objEntity)) {
            case ('Enrollment'):
                $arrEnrollments = array(
                    $objEntity
                );
            break;
            case ('Athelete'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idAthelete = %s', $objEntity->IdAthelete);
                $arrEnrollments = Enrollment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Competition'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idCompetition = %s', $objEntity->IdCompetition);
                $arrEnrollments = Enrollment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Session'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idSession = %s', $objEntity->IdSession);
                $arrEnrollments = Enrollment::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedEnrollments = $arrEnrollments;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strFlight->GetValue())) {
            $arrAndConditions[] = sprintf('flight LIKE "%s%%"', $this->strFlight->GetValue());
        }
        if (!is_null($this->strDivision->GetValue())) {
            $arrAndConditions[] = sprintf('division LIKE "%s%%"', $this->strDivision->GetValue());
        }
        if (!is_null($this->strAgeGroup->GetValue())) {
            $arrAndConditions[] = sprintf('ageGroup LIKE "%s%%"', $this->strAgeGroup->GetValue());
        }
        if (!is_null($this->strMisc1->GetValue())) {
            $arrAndConditions[] = sprintf('misc1 LIKE "%s%%"', $this->strMisc1->GetValue());
        }
        if (!is_null($this->strMisc2->GetValue())) {
            $arrAndConditions[] = sprintf('misc2 LIKE "%s%%"', $this->strMisc2->GetValue());
        }
        if (!is_null($this->strMisc3->GetValue())) {
            $arrAndConditions[] = sprintf('misc3 LIKE "%s%%"', $this->strMisc3->GetValue());
        }
        if (!is_null($this->strMisc4->GetValue())) {
            $arrAndConditions[] = sprintf('misc4 LIKE "%s%%"', $this->strMisc4->GetValue());
        }
        if (!is_null($this->strMisc5->GetValue())) {
            $arrAndConditions[] = sprintf('misc5 LIKE "%s%%"', $this->strMisc5->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strLevel->GetValue())) {
            $arrAndConditions[] = sprintf('level LIKE "%s%%"', $this->strLevel->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedEnrollments;
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
