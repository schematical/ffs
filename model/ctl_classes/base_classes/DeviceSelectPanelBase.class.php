<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* Classes list:
* - DeviceSelectPanelBase extends MJaxPanel
*/
class DeviceSelectPanelBase extends MJaxPanel {
    protected $arrSelectedDevices = array();
    public $txtSearch = null;
    //public $tblDevices = null;
    public $intIdDevice = null;
    public $strName = null;
    public $strToken = null;
    public $strInviteEmail = null;
    public $intIdOrg = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchDevice');
        $this->txtSearch->Name = 'idDevice';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdDevice = new MJaxTextBox($this);
        $this->intIdDevice->Attr('placeholder', " Device");
        $this->strName = new MJaxTextBox($this);
        $this->strName->Attr('placeholder', " Name");
        $this->strToken = new MJaxTextBox($this);
        $this->strToken->Attr('placeholder', " Token");
        $this->strInviteEmail = new MJaxTextBox($this);
        $this->strInviteEmail->Attr('placeholder', " Invite Email");
        $this->intIdOrg = new MJaxTextBox($this);
        $this->intIdOrg->Attr('placeholder', " Org");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedDevices = array();
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
        $arrDevices = array();
        if (is_null($objEntity)) {
            return $arrDevices;
        }
        switch (get_class($objEntity)) {
            case ('Device'):
                $arrDevices = array(
                    $objEntity
                );
            break;
            case ('Org'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idOrg = %s', $objEntity->IdOrg);
                $arrDevices = Device::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedDevices = $arrDevices;
        $this->TriggerEvent('mjax-bs-autocomplete-select');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        if (!is_null($this->strName->GetValue())) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $this->strName->GetValue());
        }
        if (!is_null($this->strToken->GetValue())) {
            $arrAndConditions[] = sprintf('token LIKE "%s%%"', $this->strToken->GetValue());
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strInviteEmail->GetValue())) {
            $arrAndConditions[] = sprintf('inviteEmail LIKE "%s%%"', $this->strInviteEmail->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedDevices;
    }
}
