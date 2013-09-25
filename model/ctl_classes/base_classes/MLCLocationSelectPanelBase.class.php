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
* - MLCLocationSelectPanelBase extends MJaxPanel
*/
class MLCLocationSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedMLCLocations = array();
    public $txtSearch = null;
    //public $tblMLCLocations = null;
    public $intIdLocation = null;
    public $strShortDesc = null;
    public $strAddress1 = null;
    public $strAddress2 = null;
    public $strCity = null;
    public $strState = null;
    public $strZip = null;
    public $strCountry = null;
    public $fltLat = null;
    public $fltLng = null;
    public $intIdAccount = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=MLCLocation';
        $this->txtSearch->Name = 'idMLCLocation';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdLocation = new MJaxTextBox($this);
        $this->intIdLocation->Attr('placeholder', " Location");
        $this->strShortDesc = new MJaxTextBox($this);
        $this->strShortDesc->Attr('placeholder', " Short Desc");
        $this->strAddress1 = new MJaxTextBox($this);
        $this->strAddress1->Attr('placeholder', " Address 1");
        $this->strAddress2 = new MJaxTextBox($this);
        $this->strAddress2->Attr('placeholder', " Address 2");
        $this->strCity = new MJaxTextBox($this);
        $this->strCity->Attr('placeholder', " City");
        $this->strState = new MJaxTextBox($this);
        $this->strState->Attr('placeholder', " State");
        $this->strZip = new MJaxTextBox($this);
        $this->strZip->Attr('placeholder', " Zip");
        $this->strCountry = new MJaxTextBox($this);
        $this->strCountry->Attr('placeholder', " Country");
        $this->fltLat = new MJaxTextBox($this);
        $this->fltLat->Attr('placeholder', " Lat");
        $this->fltLng = new MJaxTextBox($this);
        $this->fltLng->Attr('placeholder', " Lng");
        $this->intIdAccount = new MJaxTextBox($this);
        $this->intIdAccount->Attr('placeholder', " Account");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedMLCLocations = array();
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
        $arrMLCLocations = array();
        if (is_null($objEntity)) {
            return $arrMLCLocations;
        }
        switch (get_class($objEntity)) {
            case ('MLCLocation'):
                $arrMLCLocations = array(
                    $objEntity
                );
            break;
            case ('AuthAccount'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idAccount = %s', $objEntity->IdAccount);
                $arrMLCLocations = MLCLocation::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedMLCLocations = $arrMLCLocations;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strShortDesc->GetValue())) {
            $arrAndConditions[] = sprintf('shortDesc LIKE "%s%%"', $this->strShortDesc->GetValue());
        }
        if (!is_null($this->strAddress1->GetValue())) {
            $arrAndConditions[] = sprintf('address1 LIKE "%s%%"', $this->strAddress1->GetValue());
        }
        if (!is_null($this->strAddress2->GetValue())) {
            $arrAndConditions[] = sprintf('address2 LIKE "%s%%"', $this->strAddress2->GetValue());
        }
        if (!is_null($this->strCity->GetValue())) {
            $arrAndConditions[] = sprintf('city LIKE "%s%%"', $this->strCity->GetValue());
        }
        if (!is_null($this->strState->GetValue())) {
            $arrAndConditions[] = sprintf('state LIKE "%s%%"', $this->strState->GetValue());
        }
        if (!is_null($this->strZip->GetValue())) {
            $arrAndConditions[] = sprintf('zip LIKE "%s%%"', $this->strZip->GetValue());
        }
        if (!is_null($this->strCountry->GetValue())) {
            $arrAndConditions[] = sprintf('country LIKE "%s%%"', $this->strCountry->GetValue());
        }
        if (!is_null($this->fltLat->GetValue())) {
            $arrAndConditions[] = sprintf('lat LIKE "%s%%"', $this->fltLat->GetValue());
        }
        if (!is_null($this->fltLng->GetValue())) {
            $arrAndConditions[] = sprintf('lng LIKE "%s%%"', $this->fltLng->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedMLCLocations;
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
