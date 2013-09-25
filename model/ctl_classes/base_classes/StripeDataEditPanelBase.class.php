<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - GetStripeData()
* - SetStripeData()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitModeAutocomplete()
* - InitInstance_urlAutocomplete()
* - InitStripeIdAutocomplete()
* Classes list:
* - StripeDataEditPanelBase extends MJaxPanel
*/
class StripeDataEditPanelBase extends MJaxPanel {
    protected $objStripeData = null;
    public $intIdStripeData = null;
    public $strData = null;
    public $strObject = null;
    public $intIdAuthUser = null;
    public $dttCreDate = null;
    public $intIdParentStripeData = null;
    public $strMode = null;
    public $strInstance_url = null;
    public $strStripeId = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objStripeData = null) {
        parent::__construct($objParentControl);
        $this->objStripeData = $objStripeData;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/StripeDataEditPanelBase.tpl.php';
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
        if (is_null($this->objStripeData)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        //Is special field!!!!!
        $this->strObject = new MJaxTextBox($this);
        $this->strObject->Name = 'object';
        $this->strObject->AddCssClass('input-large');
        //longtext
        $this->strObject->TextMode = MJaxTextMode::MultiLine;
        $this->intIdAuthUser = new MJaxTextBox($this);
        $this->intIdAuthUser->Name = 'idAuthUser';
        $this->intIdAuthUser->AddCssClass('input-large');
        //int(11)
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->strMode = new MJaxTextBox($this);
        $this->strMode->Name = 'mode';
        $this->strMode->AddCssClass('input-large');
        //varchar(64)
        $this->strInstance_url = new MJaxTextBox($this);
        $this->strInstance_url->Name = 'instance_url';
        $this->strInstance_url->AddCssClass('input-large');
        //varchar(256)
        $this->strStripeId = new MJaxTextBox($this);
        $this->strStripeId->Name = 'stripeId';
        $this->strStripeId->AddCssClass('input-large');
        //varchar(45)
        if (!is_null($this->objStripeData)) {
            $this->SetStripeData($this->objStripeData);
        }
    }
    public function GetStripeData() {
        if (is_null($this->objStripeData)) {
            //Create a new one
            $this->objStripeData = new StripeData();
        }
        //Is special field!!!!!
        if (get_class($this->strObject) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strObject->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('object');
            }
            $this->objStripeData->object = $mixEntity;
        } else {
            $this->objStripeData->object = $this->strObject->Text;
        }
        if (get_class($this->intIdAuthUser) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intIdAuthUser->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('idAuthUser');
            }
            $this->objStripeData->idAuthUser = $mixEntity;
        } else {
            $this->objStripeData->idAuthUser = $this->intIdAuthUser->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (get_class($this->strMode) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMode->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('mode');
            }
            $this->objStripeData->mode = $mixEntity;
        } else {
            $this->objStripeData->mode = $this->strMode->Text;
        }
        if (get_class($this->strInstance_url) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strInstance_url->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('instance_url');
            }
            $this->objStripeData->instance_url = $mixEntity;
        } else {
            $this->objStripeData->instance_url = $this->strInstance_url->Text;
        }
        if (get_class($this->strStripeId) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strStripeId->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('stripeId');
            }
            $this->objStripeData->stripeId = $mixEntity;
        } else {
            $this->objStripeData->stripeId = $this->strStripeId->Text;
        }
        return $this->objStripeData;
    }
    public function SetStripeData($objStripeData) {
        $this->objStripeData = $objStripeData;
        $this->ActionParameter = $this->objStripeData;
        $this->blnModified = true;
        if (!is_null($this->objStripeData)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdStripeData = $this->objStripeData->idStripeData;
            //Is special field!!!!!
            $this->strObject->Text = $this->objStripeData->object;
            $this->intIdAuthUser->Text = $this->objStripeData->idAuthUser;
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->strMode->Text = $this->objStripeData->mode;
            $this->strInstance_url->Text = $this->objStripeData->instance_url;
            $this->strStripeId->Text = $this->objStripeData->stripeId;
        } else {
            //Is special field!!!!!
            $this->strObject->Text = '';
            $this->intIdAuthUser->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->strMode->Text = '';
            $this->strInstance_url->Text = '';
            $this->strStripeId->Text = '';
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objStripeData)) {
        }
    }
    public function btnSave_click() {
        $this->GetStripeData()->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objStripeData;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objStripeData->MarkDeleted();
        $this->SetStripeData(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objStripeData);
    }
    public function InitModeAutocomplete() {
        $this->strMode = new MJaxBSAutocompleteTextBox($this);
        $this->strMode->SetSearchEntity('stripedata', 'mode');
        $this->strMode->Name = 'mode';
        $this->strMode->AddCssClass('input-large');
    }
    public function InitInstance_urlAutocomplete() {
        $this->strInstance_url = new MJaxBSAutocompleteTextBox($this);
        $this->strInstance_url->SetSearchEntity('stripedata', 'instance_url');
        $this->strInstance_url->Name = 'instance_url';
        $this->strInstance_url->AddCssClass('input-large');
    }
    public function InitStripeIdAutocomplete() {
        $this->strStripeId = new MJaxBSAutocompleteTextBox($this);
        $this->strStripeId->SetSearchEntity('stripedata', 'stripeId');
        $this->strStripeId->Name = 'stripeId';
        $this->strStripeId->AddCssClass('input-large');
    }
}
?>