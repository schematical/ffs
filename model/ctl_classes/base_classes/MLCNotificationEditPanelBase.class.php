<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetMLCNotification()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* Classes list:
* - MLCNotificationEditPanelBase extends MJaxPanel
*/
class MLCNotificationEditPanelBase extends MJaxPanel {
    protected $objMLCNotification = null;
    public $intIdNotification = null;
    public $intIdUser = null;
    public $dttCreDate = null;
    public $strClassName = null;
    public $strData = null;
    public $intViewed = null;
    public $lnkViewParentIdUser = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objMLCNotification = null) {
        parent::__construct($objParentControl);
        $this->objMLCNotification = $objMLCNotification;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/MLCNotificationEditPanelBase.tpl.php';
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
        if (is_null($this->objMLCNotification)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->strClassName = new MJaxTextBox($this);
        $this->strClassName->Name = 'className';
        $this->strClassName->AddCssClass('input-large');
        //varchar(64)
        //Is special field!!!!!
        $this->intViewed = new MJaxTextBox($this);
        $this->intViewed->Name = 'viewed';
        $this->intViewed->AddCssClass('input-large');
        //int(1)
        if (!is_null($this->objMLCNotification)) {
            $this->SetMLCNotification($this->objMLCNotification);
        }
    }
    public function SetMLCNotification($objMLCNotification) {
        $this->objMLCNotification = $objMLCNotification;
        $this->ActionParameter = $this->objMLCNotification;
        $this->blnModified = true;
        if (!is_null($this->objMLCNotification)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdNotification = $this->objMLCNotification->idNotification;
            //Is special field!!!!!
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strClassName->Text = $this->objMLCNotification->className;
            //Is special field!!!!!
            $this->intViewed->Text = $this->objMLCNotification->viewed;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objMLCNotification)) {
            if (!is_null($this->objMLCNotification->idUser)) {
                $this->lnkViewParentIdUser = new MJaxLinkButton($this);
                $this->lnkViewParentIdUser->Text = 'View AuthUser';
                $this->lnkViewParentIdUser->Href = __ENTITY_MODEL_DIR__ . '/AuthUser/' . $this->objMLCNotification->idUser;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objMLCNotification)) {
            //Create a new one
            $this->objMLCNotification = new MLCNotification();
        }
        //Is special field!!!!!
        $this->objMLCNotification->idUser = MLCAuthDriver::IdUser();
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->objMLCNotification->className = $this->strClassName->Text;
        //Is special field!!!!!
        $this->objMLCNotification->viewed = $this->intViewed->Text;
        $this->objMLCNotification->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objMLCNotification;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objMLCNotification->MarkDeleted();
        $this->SetMLCNotification(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objMLCNotification);
    }
}
?>