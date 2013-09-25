<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - GetTrackingEvent()
* - SetTrackingEvent()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitNameAutocomplete()
* - InitValueAutocomplete()
* - InitIdSessionAutocomplete()
* - InitAppAutocomplete()
* Classes list:
* - TrackingEventEditPanelBase extends MJaxPanel
*/
class TrackingEventEditPanelBase extends MJaxPanel {
    protected $objTrackingEvent = null;
    public $intIdTrackingEvent = null;
    public $strName = null;
    public $strValue = null;
    public $dttCreDate = null;
    public $intIdUser = null;
    public $intIdSession = null;
    public $intIdApplication = null;
    public $strApp = null;
    public $lnkViewParentIdSession = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objTrackingEvent = null) {
        parent::__construct($objParentControl);
        $this->objTrackingEvent = $objTrackingEvent;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/TrackingEventEditPanelBase.tpl.php';
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
        if (is_null($this->objTrackingEvent)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strName = new MJaxTextBox($this);
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
        //varchar(32)
        $this->strValue = new MJaxTextBox($this);
        $this->strValue->Name = 'value';
        $this->strValue->AddCssClass('input-large');
        //varchar(256)
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->intIdApplication = new MJaxTextBox($this);
        $this->intIdApplication->Name = 'idApplication';
        $this->intIdApplication->AddCssClass('input-large');
        //int(11)
        $this->strApp = new MJaxTextBox($this);
        $this->strApp->Name = 'app';
        $this->strApp->AddCssClass('input-large');
        //varchar(32)
        if (!is_null($this->objTrackingEvent)) {
            $this->SetTrackingEvent($this->objTrackingEvent);
        }
    }
    public function GetTrackingEvent() {
        if (is_null($this->objTrackingEvent)) {
            //Create a new one
            $this->objTrackingEvent = new TrackingEvent();
        }
        if (get_class($this->strName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('name');
            }
            $this->objTrackingEvent->name = $mixEntity;
        } else {
            $this->objTrackingEvent->name = $this->strName->Text;
        }
        if (get_class($this->strValue) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strValue->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('value');
            }
            $this->objTrackingEvent->value = $mixEntity;
        } else {
            $this->objTrackingEvent->value = $this->strValue->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->objTrackingEvent->idUser = MLCAuthDriver::IdUser();
        if (get_class($this->intIdApplication) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intIdApplication->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('idApplication');
            }
            $this->objTrackingEvent->idApplication = $mixEntity;
        } else {
            $this->objTrackingEvent->idApplication = $this->intIdApplication->Text;
        }
        if (get_class($this->strApp) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strApp->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('app');
            }
            $this->objTrackingEvent->app = $mixEntity;
        } else {
            $this->objTrackingEvent->app = $this->strApp->Text;
        }
        return $this->objTrackingEvent;
    }
    public function SetTrackingEvent($objTrackingEvent) {
        $this->objTrackingEvent = $objTrackingEvent;
        $this->ActionParameter = $this->objTrackingEvent;
        $this->blnModified = true;
        if (!is_null($this->objTrackingEvent)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdTrackingEvent = $this->objTrackingEvent->idTrackingEvent;
            $this->strName->Text = $this->objTrackingEvent->name;
            $this->strValue->Text = $this->objTrackingEvent->value;
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->intIdApplication->Text = $this->objTrackingEvent->idApplication;
            $this->strApp->Text = $this->objTrackingEvent->app;
        } else {
            $this->strName->Text = '';
            $this->strValue->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->intIdApplication->Text = '';
            $this->strApp->Text = '';
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objTrackingEvent)) {
            if (!is_null($this->objTrackingEvent->idSession)) {
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View AuthSession';
                $this->lnkViewParentIdSession->Href = '/data/editTrackingEvent?' . FFSQS::TrackingEvent_IdSession . $this->objTrackingEvent->idSession;
            }
        }
    }
    public function btnSave_click() {
        $this->GetTrackingEvent()->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objTrackingEvent;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objTrackingEvent->MarkDeleted();
        $this->SetTrackingEvent(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objTrackingEvent);
    }
    public function InitNameAutocomplete() {
        $this->strName = new MJaxBSAutocompleteTextBox($this);
        $this->strName->SetSearchEntity('trackingevent', 'name');
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
    }
    public function InitValueAutocomplete() {
        $this->strValue = new MJaxBSAutocompleteTextBox($this);
        $this->strValue->SetSearchEntity('trackingevent', 'value');
        $this->strValue->Name = 'value';
        $this->strValue->AddCssClass('input-large');
    }
    public function InitIdSessionAutocomplete() {
        $this->intIdSession = new MJaxBSAutocompleteTextBox($this);
        $this->intIdSession->SetSearchEntity('authsession');
        $this->intIdSession->Name = 'idSession';
        $this->intIdSession->AddCssClass('input-large');
    }
    public function InitAppAutocomplete() {
        $this->strApp = new MJaxBSAutocompleteTextBox($this);
        $this->strApp->SetSearchEntity('trackingevent', 'app');
        $this->strApp->Name = 'app';
        $this->strApp->AddCssClass('input-large');
    }
}
?>