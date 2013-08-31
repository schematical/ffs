<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetAssignment()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* Classes list:
* - AssignmentEditPanelBase extends MJaxPanel
*/
class AssignmentEditPanelBase extends MJaxPanel {
    protected $objAssignment = null;
    public $intIdAssignment = null;
    public $intIdDevice = null;
    public $intIdSession = null;
    public $strEvent = null;
    public $strApartatus = null;
    public $dttCreDate = null;
    public $intIdUser = null;
    public $dttRevokeDate = null;
    public $lnkViewParentIdDevice = null;
    public $lnkViewParentIdSession = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objAssignment = null) {
        parent::__construct($objParentControl);
        $this->objAssignment = $objAssignment;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/AssignmentEditPanelBase.tpl.php';
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
        if (is_null($this->objAssignment)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strEvent = new MJaxTextBox($this);
        $this->strEvent->Name = 'event';
        $this->strEvent->AddCssClass('input-large');
        //varchar(64)
        $this->strApartatus = new MJaxTextBox($this);
        $this->strApartatus->Name = 'apartatus';
        $this->strApartatus->AddCssClass('input-large');
        //varchar(64)
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        //Is special field!!!!!
        $this->dttRevokeDate = new MJaxBSDateTimePicker($this);
        if (!is_null($this->objAssignment)) {
            $this->SetAssignment($this->objAssignment);
        }
    }
    public function SetAssignment($objAssignment) {
        $this->objAssignment = $objAssignment;
        $this->ActionParameter = $this->objAssignment;
        $this->blnModified = true;
        if (!is_null($this->objAssignment)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdAssignment = $this->objAssignment->idAssignment;
            $this->strEvent->Text = $this->objAssignment->event;
            $this->strApartatus->Text = $this->objAssignment->apartatus;
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            //Is special field!!!!!
            $this->dttRevokeDate->Value = $this->objAssignment->revokeDate;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objAssignment)) {
            if (!is_null($this->objAssignment->idDevice)) {
                $this->lnkViewParentIdDevice = new MJaxLinkButton($this);
                $this->lnkViewParentIdDevice->Text = 'View Device';
                $this->lnkViewParentIdDevice->Href = __ENTITY_MODEL_DIR__ . '/Device/' . $this->objAssignment->idDevice;
            }
            if (!is_null($this->objAssignment->idSession)) {
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View Session';
                $this->lnkViewParentIdSession->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objAssignment->idSession;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objAssignment)) {
            //Create a new one
            $this->objAssignment = new Assignment();
        }
        $this->objAssignment->event = $this->strEvent->Text;
        $this->objAssignment->apartatus = $this->strApartatus->Text;
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->objAssignment->idUser = MLCAuthDriver::IdUser();
        //Is special field!!!!!
        $this->objAssignment->revokeDate = $this->dttRevokeDate->GetValue();
        $this->objAssignment->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objAssignment;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objAssignment->MarkDeleted();
        $this->SetAssignment(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objAssignment);
    }
}
?>