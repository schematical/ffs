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
* - IsNew()
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
        $this->objAthelete->firstName = $this->strFirstName->Text;
        $this->objAthelete->lastName = $this->strLastName->Text;
        //Is special field!!!!!
        $this->objAthelete->birthDate = $this->dttBirthDate->GetValue();
        $this->objAthelete->memType = $this->strMemType->Text;
        $this->objAthelete->memId = $this->strMemId->Text;
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->objAthelete->level = $this->strLevel->Text;
        $this->objAthelete->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objAthelete;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->objAthelete->MarkDeleted();
        $this->SetAthelete(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objAthelete);
    }
}
?>