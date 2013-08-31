<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* Classes list:
* - OrgSelectPanelBase extends MJaxPanel
*/
class OrgSelectPanelBase extends MJaxPanel {
    protected $arrSelectedOrgs = array();
    public $txtSearch = null;
    //public $tblOrgs = null;
    public $intIdOrg = null;
    public $strNamespace = null;
    public $strName = null;
    public $strPsData = null;
    public $intIdImportAuthUser = null;
    public $strClubNum = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchOrg');
        $this->txtSearch->Name = 'idOrg';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdOrg = new MJaxTextBox($this);
        $this->intIdOrg->Attr('placeholder', " Org");
        $this->strNamespace = new MJaxTextBox($this);
        $this->strNamespace->Attr('placeholder', " Namespace");
        $this->strName = new MJaxTextBox($this);
        $this->strName->Attr('placeholder', " Name");
        $this->strPsData = new MJaxTextBox($this);
        $this->strPsData->Attr('placeholder', " Ps Data");
        $this->intIdImportAuthUser = new MJaxTextBox($this);
        $this->intIdImportAuthUser->Attr('placeholder', " Import Auth User");
        $this->strClubNum = new MJaxTextBox($this);
        $this->strClubNum->Attr('placeholder', " Club Num");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedOrgs = array();
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
        $arrOrgs = array();
        if (is_null($objEntity)) {
            return $arrOrgs;
        }
        switch (get_class($objEntity)) {
            case ('Org'):
                $arrOrgs = array(
                    $objEntity
                );
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedOrgs = $arrOrgs;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strNamespace->GetValue())) {
            $arrAndConditions[] = sprintf('namespace LIKE "%s%%"', $this->strNamespace->GetValue());
        }
        if (!is_null($this->strName->GetValue())) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (!is_null($this->intIdImportAuthUser->GetValue())) {
            $arrAndConditions[] = sprintf('idImportAuthUser LIKE "%s%%"', $this->intIdImportAuthUser->GetValue());
        }
        if (!is_null($this->strClubNum->GetValue())) {
            $arrAndConditions[] = sprintf('clubNum LIKE "%s%%"', $this->strClubNum->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedOrgs;
    }
}
