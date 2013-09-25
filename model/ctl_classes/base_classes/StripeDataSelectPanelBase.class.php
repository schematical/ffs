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
* - StripeDataSelectPanelBase extends MJaxPanel
*/
class StripeDataSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedStripeDatas = array();
    public $txtSearch = null;
    //public $tblStripeDatas = null;
    public $intIdStripeData = null;
    public $strData = null;
    public $strObject = null;
    public $intIdAuthUser = null;
    public $intIdParentStripeData = null;
    public $strMode = null;
    public $strInstance_url = null;
    public $strStripeId = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=StripeData';
        $this->txtSearch->Name = 'idStripeData';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdStripeData = new MJaxTextBox($this);
        $this->intIdStripeData->Attr('placeholder', " Stripe Data");
        $this->strData = new MJaxTextBox($this);
        $this->strData->Attr('placeholder', " Data");
        $this->strObject = new MJaxTextBox($this);
        $this->strObject->Attr('placeholder', " Object");
        $this->intIdAuthUser = new MJaxTextBox($this);
        $this->intIdAuthUser->Attr('placeholder', " Auth User");
        $this->intIdParentStripeData = new MJaxTextBox($this);
        $this->intIdParentStripeData->Attr('placeholder', " Parent Stripe Data");
        $this->strMode = new MJaxTextBox($this);
        $this->strMode->Attr('placeholder', " Mode");
        $this->strInstance_url = new MJaxTextBox($this);
        $this->strInstance_url->Attr('placeholder', " Instance _url");
        $this->strStripeId = new MJaxTextBox($this);
        $this->strStripeId->Attr('placeholder', " Stripe Id");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedStripeDatas = array();
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
        $arrStripeDatas = array();
        if (is_null($objEntity)) {
            return $arrStripeDatas;
        }
        switch (get_class($objEntity)) {
            case ('StripeData'):
                $arrStripeDatas = array(
                    $objEntity
                );
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedStripeDatas = $arrStripeDatas;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        //Is special field!!!!!
        if (!is_null($this->strObject->GetValue())) {
            $arrAndConditions[] = sprintf('object LIKE "%s%%"', $this->strObject->GetValue());
        }
        if (!is_null($this->intIdAuthUser->GetValue())) {
            $arrAndConditions[] = sprintf('idAuthUser LIKE "%s%%"', $this->intIdAuthUser->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (!is_null($this->strMode->GetValue())) {
            $arrAndConditions[] = sprintf('mode LIKE "%s%%"', $this->strMode->GetValue());
        }
        if (!is_null($this->strInstance_url->GetValue())) {
            $arrAndConditions[] = sprintf('instance_url LIKE "%s%%"', $this->strInstance_url->GetValue());
        }
        if (!is_null($this->strStripeId->GetValue())) {
            $arrAndConditions[] = sprintf('stripeId LIKE "%s%%"', $this->strStripeId->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedStripeDatas;
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
