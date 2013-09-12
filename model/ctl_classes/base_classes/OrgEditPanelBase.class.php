<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetOrg()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitNamespaceAutocomplete()
* - InitNameAutocomplete()
* - InitClubNumAutocomplete()
* - InitClubTypeAutocomplete()
* Classes list:
* - OrgEditPanelBase extends MJaxPanel
*/
class OrgEditPanelBase extends MJaxPanel {
    protected $objOrg = null;
    public $intIdOrg = null;
    public $strNamespace = null;
    public $strName = null;
    public $dttCreDate = null;
    public $strPsData = null;
    public $intIdImportAuthUser = null;
    public $strClubNum = null;
    public $strClubType = null;
    public $lnkViewChildAthelete = null;
    public $lnkViewChildCompetition = null;
    public $lnkViewChildDevice = null;
    public $lnkViewChildOrgCompetition = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objOrg = null) {
        parent::__construct($objParentControl);
        $this->objOrg = $objOrg;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/OrgEditPanelBase.tpl.php';
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
        if (is_null($this->objOrg)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        $this->strNamespace = new MJaxTextBox($this);
        $this->strNamespace->Name = 'namespace';
        $this->strNamespace->AddCssClass('input-large');
        //varchar(64)
        $this->strName = new MJaxTextBox($this);
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
        //varchar(128)
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        $this->intIdImportAuthUser = new MJaxTextBox($this);
        $this->intIdImportAuthUser->Name = 'idImportAuthUser';
        $this->intIdImportAuthUser->AddCssClass('input-large');
        //int(11)
        $this->strClubNum = new MJaxTextBox($this);
        $this->strClubNum->Name = 'clubNum';
        $this->strClubNum->AddCssClass('input-large');
        //varchar(64)
        $this->strClubType = new MJaxTextBox($this);
        $this->strClubType->Name = 'clubType';
        $this->strClubType->AddCssClass('input-large');
        //varchar(45)
        if (!is_null($this->objOrg)) {
            $this->SetOrg($this->objOrg);
        }
    }
    public function SetOrg($objOrg) {
        $this->objOrg = $objOrg;
        $this->ActionParameter = $this->objOrg;
        $this->blnModified = true;
        if (!is_null($this->objOrg)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdOrg = $this->objOrg->idOrg;
            $this->strNamespace->Text = $this->objOrg->namespace;
            $this->strName->Text = $this->objOrg->name;
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->intIdImportAuthUser->Text = $this->objOrg->idImportAuthUser;
            $this->strClubNum->Text = $this->objOrg->clubNum;
            $this->strClubType->Text = $this->objOrg->clubType;
        } else {
            $this->strNamespace->Text = '';
            $this->strName->Text = '';
            //Is special field!!!!!
            //Do nothing this is a creDate
            //Is special field!!!!!
            $this->intIdImportAuthUser->Text = '';
            $this->strClubNum->Text = '';
            $this->strClubType->Text = '';
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objOrg)) {
        }
        $this->lnkViewChildAthelete = new MJaxLinkButton($this);
        $this->lnkViewChildAthelete->Text = 'View Atheletes';
        //I should really fix this
        //$this->lnkViewChildAthelete->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objOrg->idOrg . '/Atheletes';
        $this->lnkViewChildCompetition = new MJaxLinkButton($this);
        $this->lnkViewChildCompetition->Text = 'View Competitions';
        //I should really fix this
        //$this->lnkViewChildCompetition->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objOrg->idOrg . '/Competitions';
        $this->lnkViewChildDevice = new MJaxLinkButton($this);
        $this->lnkViewChildDevice->Text = 'View Devices';
        //I should really fix this
        //$this->lnkViewChildDevice->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objOrg->idOrg . '/Devices';
        $this->lnkViewChildOrgCompetition = new MJaxLinkButton($this);
        $this->lnkViewChildOrgCompetition->Text = 'View OrgCompetitions';
        //I should really fix this
        //$this->lnkViewChildOrgCompetition->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objOrg->idOrg . '/OrgCompetitions';
        
    }
    public function btnSave_click() {
        if (is_null($this->objOrg)) {
            //Create a new one
            $this->objOrg = new Org();
        }
        if (get_class($this->strNamespace) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strNamespace->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('namespace');
            }
            $this->objOrg->namespace = $mixEntity;
        } else {
            $this->objOrg->namespace = $this->strNamespace->Text;
        }
        if (get_class($this->strName) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strName->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('name');
            }
            $this->objOrg->name = $mixEntity;
        } else {
            $this->objOrg->name = $this->strName->Text;
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        //Is special field!!!!!
        if (get_class($this->intIdImportAuthUser) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intIdImportAuthUser->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('idImportAuthUser');
            }
            $this->objOrg->idImportAuthUser = $mixEntity;
        } else {
            $this->objOrg->idImportAuthUser = $this->intIdImportAuthUser->Text;
        }
        if (get_class($this->strClubNum) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strClubNum->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('clubNum');
            }
            $this->objOrg->clubNum = $mixEntity;
        } else {
            $this->objOrg->clubNum = $this->strClubNum->Text;
        }
        if (get_class($this->strClubType) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->strClubType->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('clubType');
            }
            $this->objOrg->clubType = $mixEntity;
        } else {
            $this->objOrg->clubType = $this->strClubType->Text;
        }
        $this->objOrg->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objOrg;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objOrg->MarkDeleted();
        $this->SetOrg(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objOrg);
    }
    public function InitNamespaceAutocomplete() {
        $this->strNamespace = new MJaxBSAutocompleteTextBox($this);
        $this->strNamespace->SetSearchEntity('org', 'namespace');
        $this->strNamespace->Name = 'namespace';
        $this->strNamespace->AddCssClass('input-large');
    }
    public function InitNameAutocomplete() {
        $this->strName = new MJaxBSAutocompleteTextBox($this);
        $this->strName->SetSearchEntity('org', 'name');
        $this->strName->Name = 'name';
        $this->strName->AddCssClass('input-large');
    }
    public function InitClubNumAutocomplete() {
        $this->strClubNum = new MJaxBSAutocompleteTextBox($this);
        $this->strClubNum->SetSearchEntity('org', 'clubNum');
        $this->strClubNum->Name = 'clubNum';
        $this->strClubNum->AddCssClass('input-large');
    }
    public function InitClubTypeAutocomplete() {
        $this->strClubType = new MJaxBSAutocompleteTextBox($this);
        $this->strClubType->SetSearchEntity('org', 'clubType');
        $this->strClubType->Name = 'clubType';
        $this->strClubType->AddCssClass('input-large');
    }
}
?>