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
* - OrgCompetitionSelectPanelBase extends MJaxPanel
*/
class OrgCompetitionSelectPanelBase extends MJaxPanel {
    protected $blnDisplayAdvOptions = false;
    protected $arrSelectedOrgCompetitions = array();
    public $txtSearch = null;
    //public $tblOrgCompetitions = null;
    public $intIdOrgCompetition = null;
    public $intIdOrg = null;
    public $intIdCompetition = null;
    public $intIdAuthUser = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this);
        $this->txtSearch->Url = '/data/search?mjax-route-ext=OrgCompetition';
        $this->txtSearch->Name = 'idOrgCompetition';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdOrgCompetition = new MJaxTextBox($this);
        $this->intIdOrgCompetition->Attr('placeholder', " Org Competition");
        $this->intIdOrg = new MJaxTextBox($this);
        $this->intIdOrg->Attr('placeholder', " Org");
        $this->intIdCompetition = new MJaxTextBox($this);
        $this->intIdCompetition->Attr('placeholder', " Competition");
        $this->intIdAuthUser = new MJaxTextBox($this);
        $this->intIdAuthUser->Attr('placeholder', " Auth User");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedOrgCompetitions = array();
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
        $arrOrgCompetitions = array();
        if (is_null($objEntity)) {
            return $arrOrgCompetitions;
        }
        switch (get_class($objEntity)) {
            case ('OrgCompetition'):
                $arrOrgCompetitions = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrOrgCompetitions = OrgCompetition::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            case ('Competition'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idCompetition = %s', $objEntity->IdCompetition);
                $arrOrgCompetitions = OrgCompetition::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedOrgCompetitions = $arrOrgCompetitions;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->intIdAuthUser->GetValue())) {
            $arrAndConditions[] = sprintf('idAuthUser LIKE "%s%%"', $this->intIdAuthUser->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedOrgCompetitions;
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
