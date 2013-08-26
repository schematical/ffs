<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetDevice()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - IsNew()
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
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objDevice)) {
            if (!is_null($this->objDevice->idOrg)) {
                $this->lnkViewParentIdOrg = new MJaxLinkButton($this);
                $this->lnkViewParentIdOrg->Text = 'View Org';
                $this->lnkViewParentIdOrg->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objDevice->idOrg;
            }
        }
        $this->lnkViewChildAssignment = new MJaxLinkButton($this);
        $this->lnkViewChildAssignment->Text = 'View Assignments';
        //I should really fix this
        //$this->lnkViewChildAssignment->Href = __ENTITY_MODEL_DIR__ . '/Device/' . $this->objDevice->idDevice . '/Assignments';
        
    }
    public function btnSave_click() {
        if (is_null($this->objDevice)) {
            //Create a new one
            $this->objDevice = new Device();
        }
        $this->objDevice->name = $this->strName->Text;
        $this->objDevice->token = $this->strToken->Text;
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->objDevice->inviteEmail = $this->strInviteEmail->Text;
        $this->objDevice->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objDevice;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->objDevice->MarkDeleted();
        $this->SetDevice(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objDevice);
    }
}
?>