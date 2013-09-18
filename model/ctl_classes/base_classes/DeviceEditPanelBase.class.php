<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - GetDevice()
* - SetDevice()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitNameAutocomplete()
* - InitTokenAutocomplete()
* - InitInviteEmailAutocomplete()
* - InitIdOrgAutocomplete()
* Classes list:
* - DeviceEditPanelBase extends MJaxPanel
*/
class DeviceEditPanelBase extends MJaxPanel {
    protected $objDevice = null;
    public $intIdDevice = null;
    public $strName = null;
    public $strToken = null;
    public $dttCreDate = null;
    public $strInviteEmail = null;
    public $intIdOrg = null;
    public $lnkViewParentIdOrg = null;
    public $lnkViewChildAssignment = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objDevice = null) {
        parent::__construct($objParentControl);
        $this->objDevice = $objDevice;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/DeviceEditPanelBase.tpl.php';
        $this->CreateFieldControls();
        $this->CreateContentControls();
        $this->CreateReferenceControls();
    }
    public function CreateContentControls() {
        $this->btnSave = new MJaxButton($this);
        $this->btnSave->Text = 'Save';
        $this->btnSave->AddAction(new MJaxClickEvent() , new MJaxServerControlAction($this, 'btnSave_click'));
        $this->btnSave->AddCssClass('btn btn-large');
        $this->btnDelete = new MJaxButton($this);
        $this->btnDelete->Text = 'Delete';
        $this->btnDelete->AddAction(new MJaxClickEvent() , new MJaxServerControlAction($this, 'btnDelete_click'));
        $this->btnDelete->AddCssClass('btn btn-large');
        if (is_null($this->objDevice)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strName = new MJaxTextBox($this);
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
        //varchar(64)
        $this->strToken = new MJaxTextBox($this);
        $this->strToken->Name = 'token';
        $this->strToken->AddCssClass('input-large');
        //varchar(128)
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->strInviteEmail = new MJaxTextBox($this);
        $this->strInviteEmail->Name = 'inviteEmail';
        $this->strInviteEmail->AddCssClass('input-large');
        //varchar(45)
        if (!is_null($this->objDevice)) {
            $this->SetDevice($this->objDevice);
        }
    }
    public function GetDevice() {
        if (is_null($this->objDevice)) {
            //Create a new one
            $this->objDevice = new Device();
        }
        if (get_class($this->strName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('name');
            }
            $this->objDevice->name = $mixEntity;
        } else {
            $this->objDevice->name = $this->strName->Text;
        }
        if (get_class($this->strToken) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strToken->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('token');
            }
            $this->objDevice->token = $mixEntity;
        } else {
            $this->objDevice->token = $this->strToken->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (get_class($this->strInviteEmail) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strInviteEmail->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('inviteEmail');
            }
            $this->objDevice->inviteEmail = $mixEntity;
        } else {
            $this->objDevice->inviteEmail = $this->strInviteEmail->Text;
        }
        return $this->objDevice;
    }
    public function SetDevice($objDevice) {
        $this->objDevice = $objDevice;
        $this->ActionParameter = $this->objDevice;
        $this->blnModified = true;
        if (!is_null($this->objDevice)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdDevice = $this->objDevice->idDevice;
            $this->strName->Text = $this->objDevice->name;
            $this->strToken->Text = $this->objDevice->token;
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strInviteEmail->Text = $this->objDevice->inviteEmail;
        } else {
            $this->strName->Text = '';
            $this->strToken->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strInviteEmail->Text = '';
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objDevice)) {
            if (!is_null($this->objDevice->idOrg)) {
                $this->lnkViewParentIdOrg = new MJaxLinkButton($this);
                $this->lnkViewParentIdOrg->Text = 'View Org';
                $this->lnkViewParentIdOrg->Href = '/data/editDevice?' . FFSQS::Device_IdOrg . $this->objDevice->idOrg;
            }
        }
        $this->lnkViewChildAssignment = new MJaxLinkButton($this);
        $this->lnkViewChildAssignment->Text = 'View Assignments';
        //I should really fix this
        //$this->lnkViewChildAssignment->Href = __ENTITY_MODEL_DIR__ . '/Device/' . $this->objDevice->idDevice . '/Assignments';
        
    }
    public function btnSave_click() {
        $this->GetDevice()->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objDevice;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objDevice->MarkDeleted();
        $this->SetDevice(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objDevice);
    }
    public function InitNameAutocomplete() {
        $this->strName = new MJaxBSAutocompleteTextBox($this);
        $this->strName->SetSearchEntity('device', 'name');
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
    }
    public function InitTokenAutocomplete() {
        $this->strToken = new MJaxBSAutocompleteTextBox($this);
        $this->strToken->SetSearchEntity('device', 'token');
        $this->strToken->Name = 'token';
        $this->strToken->AddCssClass('input-large');
    }
    public function InitInviteEmailAutocomplete() {
        $this->strInviteEmail = new MJaxBSAutocompleteTextBox($this);
        $this->strInviteEmail->SetSearchEntity('device', 'inviteEmail');
        $this->strInviteEmail->Name = 'inviteEmail';
        $this->strInviteEmail->AddCssClass('input-large');
    }
    public function InitIdOrgAutocomplete() {
        $this->intIdOrg = new MJaxBSAutocompleteTextBox($this);
        $this->intIdOrg->SetSearchEntity('org');
        $this->intIdOrg->Name = 'idOrg';
        $this->intIdOrg->AddCssClass('input-large');
    }
}
?>