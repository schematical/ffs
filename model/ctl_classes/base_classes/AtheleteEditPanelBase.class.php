<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetAthelete()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitIdOrgAutocomplete()
* - InitFirstNameAutocomplete()
* - InitLastNameAutocomplete()
* - InitMemTypeAutocomplete()
* - InitMemIdAutocomplete()
* - InitLevelAutocomplete()
* Classes list:
* - AtheleteEditPanelBase extends MJaxPanel
*/
class AtheleteEditPanelBase extends MJaxPanel {
    protected $objAthelete = null;
    public $intIdAthelete = null;
    public $intIdOrg = null;
    public $strFirstName = null;
    public $strLastName = null;
    public $dttBirthDate = null;
    public $strMemType = null;
    public $strMemId = null;
    public $strPsData = null;
    public $dttCreDate = null;
    public $strLevel = null;
    public $lnkViewParentIdOrg = null;
    public $lnkViewChildEnrollment = null;
    public $lnkViewChildParentMessage = null;
    public $lnkViewChildResult = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objAthelete = null) {
        parent::__construct($objParentControl);
        $this->objAthelete = $objAthelete;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/AtheleteEditPanelBase.tpl.php';
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
        if (is_null($this->objAthelete)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strFirstName = new MJaxTextBox($this);
        $this->strFirstName->Name = 'firstName';
        $this->strFirstName->AddCssClass('input-large');
        //varchar(64)
        $this->strLastName = new MJaxTextBox($this);
        $this->strLastName->Name = 'lastName';
        $this->strLastName->AddCssClass('input-large');
        //varchar(64)
        //Is special field!!!!!
        $this->dttBirthDate = new MJaxBSDateTimePicker($this);
        $this->strMemType = new MJaxTextBox($this);
        $this->strMemType->Name = 'memType';
        $this->strMemType->AddCssClass('input-large');
        //varchar(16)
        $this->strMemId = new MJaxTextBox($this);
        $this->strMemId->Name = 'memId';
        $this->strMemId->AddCssClass('input-large');
        //varchar(128)
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->strLevel = new MJaxTextBox($this);
        $this->strLevel->Name = 'level';
        $this->strLevel->AddCssClass('input-large');
        //varchar(32)
        if (!is_null($this->objAthelete)) {
            $this->SetAthelete($this->objAthelete);
        }
    }
    public function SetAthelete($objAthelete) {
        $this->objAthelete = $objAthelete;
        $this->ActionParameter = $this->objAthelete;
        $this->blnModified = true;
        if (!is_null($this->objAthelete)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdAthelete = $this->objAthelete->idAthelete;
            $this->strFirstName->Text = $this->objAthelete->firstName;
            $this->strLastName->Text = $this->objAthelete->lastName;
            //Is special field!!!!!
            $this->dttBirthDate->Value = $this->objAthelete->birthDate;
            $this->strMemType->Text = $this->objAthelete->memType;
            $this->strMemId->Text = $this->objAthelete->memId;
            //Is special field!!!!!
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->strLevel->Text = $this->objAthelete->level;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objAthelete)) {
            if (!is_null($this->objAthelete->idOrg)) {
                $this->lnkViewParentIdOrg = new MJaxLinkButton($this);
                $this->lnkViewParentIdOrg->Text = 'View Org';
                $this->lnkViewParentIdOrg->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objAthelete->idOrg;
            }
        }
        $this->lnkViewChildEnrollment = new MJaxLinkButton($this);
        $this->lnkViewChildEnrollment->Text = 'View Enrollments';
        //I should really fix this
        //$this->lnkViewChildEnrollment->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objAthelete->idAthelete . '/Enrollments';
        $this->lnkViewChildParentMessage = new MJaxLinkButton($this);
        $this->lnkViewChildParentMessage->Text = 'View ParentMessages';
        //I should really fix this
        //$this->lnkViewChildParentMessage->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objAthelete->idAthelete . '/ParentMessages';
        $this->lnkViewChildResult = new MJaxLinkButton($this);
        $this->lnkViewChildResult->Text = 'View Results';
        //I should really fix this
        //$this->lnkViewChildResult->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objAthelete->idAthelete . '/Results';
        
    }
    public function btnSave_click() {
        if (is_null($this->objAthelete)) {
            //Create a new one
            $this->objAthelete = new Athelete();
        }
        if (get_class($this->strFirstName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strFirstName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('firstName');
            }
            $this->objAthelete->firstName = $mixEntity;
        } else {
            $this->objAthelete->firstName = $this->strFirstName->Text;
        }
        if (get_class($this->strLastName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strLastName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('lastName');
            }
            $this->objAthelete->lastName = $mixEntity;
        } else {
            $this->objAthelete->lastName = $this->strLastName->Text;
        }
        //Is special field!!!!!
        $this->objAthelete->birthDate = $this->dttBirthDate->GetValue();
        if (get_class($this->strMemType) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMemType->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('memType');
            }
            $this->objAthelete->memType = $mixEntity;
        } else {
            $this->objAthelete->memType = $this->strMemType->Text;
        }
        if (get_class($this->strMemId) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strMemId->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('memId');
            }
            $this->objAthelete->memId = $mixEntity;
        } else {
            $this->objAthelete->memId = $this->strMemId->Text;
        }
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (get_class($this->strLevel) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strLevel->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('level');
            }
            $this->objAthelete->level = $mixEntity;
        } else {
            $this->objAthelete->level = $this->strLevel->Text;
        }
        $this->objAthelete->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objAthelete;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objAthelete->MarkDeleted();
        $this->SetAthelete(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objAthelete);
    }
    public function InitIdOrgAutocomplete() {
        $this->intIdOrg = new MJaxBSAutocompleteTextBox($this);
        $this->intIdOrg->SetSearchEntity('org');
        $this->intIdOrg->Name = 'idOrg';
        $this->intIdOrg->AddCssClass('input-large');
    }
    public function InitFirstNameAutocomplete() {
        $this->strFirstName = new MJaxBSAutocompleteTextBox($this);
        $this->strFirstName->SetSearchEntity('athelete', 'firstName');
        $this->strFirstName->Name = 'firstName';
        $this->strFirstName->AddCssClass('input-large');
    }
    public function InitLastNameAutocomplete() {
        $this->strLastName = new MJaxBSAutocompleteTextBox($this);
        $this->strLastName->SetSearchEntity('athelete', 'lastName');
        $this->strLastName->Name = 'lastName';
        $this->strLastName->AddCssClass('input-large');
    }
    public function InitMemTypeAutocomplete() {
        $this->strMemType = new MJaxBSAutocompleteTextBox($this);
        $this->strMemType->SetSearchEntity('athelete', 'memType');
        $this->strMemType->Name = 'memType';
        $this->strMemType->AddCssClass('input-large');
    }
    public function InitMemIdAutocomplete() {
        $this->strMemId = new MJaxBSAutocompleteTextBox($this);
        $this->strMemId->SetSearchEntity('athelete', 'memId');
        $this->strMemId->Name = 'memId';
        $this->strMemId->AddCssClass('input-large');
    }
    public function InitLevelAutocomplete() {
        $this->strLevel = new MJaxBSAutocompleteTextBox($this);
        $this->strLevel->SetSearchEntity('athelete', 'level');
        $this->strLevel->Name = 'level';
        $this->strLevel->AddCssClass('input-large');
    }
}
?>