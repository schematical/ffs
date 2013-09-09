<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - CreateContentControls()
* - CreateFieldControls()
* - SetOrgCompetition()
* - CreateReferenceControls()
* - btnSave_click()
* - btnDelete_click()
* - btnDelete_confirm()
* - IsNew()
* - InitIdOrgAutocomplete()
* - InitIdCompetitionAutocomplete()
* Classes list:
* - OrgCompetitionEditPanelBase extends MJaxPanel
*/
class OrgCompetitionEditPanelBase extends MJaxPanel {
    protected $objOrgCompetition = null;
    public $intIdOrgCompetition = null;
    public $intIdOrg = null;
    public $intIdCompetition = null;
    public $dttCreDate = null;
    public $intIdAuthUser = null;
    public $lnkViewParentIdOrg = null;
    public $lnkViewParentIdCompetition = null;
    //Regular controls
    public $btnSave = null;
    public $btnDelete = null;
    public function __construct($objParentControl, $objOrgCompetition = null) {
        parent::__construct($objParentControl);
        $this->objOrgCompetition = $objOrgCompetition;
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/OrgCompetitionEditPanelBase.tpl.php';
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
        if (is_null($this->objOrgCompetition)) {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateFieldControls() {
        //Is special field!!!!!
        //Do nothing this is a creDate
        $this->intIdAuthUser = new MJaxTextBox($this);
        $this->intIdAuthUser->Name = 'idAuthUser';
        $this->intIdAuthUser->AddCssClass('input-large');
        //int(11)
        if (!is_null($this->objOrgCompetition)) {
            $this->SetOrgCompetition($this->objOrgCompetition);
        }
    }
    public function SetOrgCompetition($objOrgCompetition) {
        $this->objOrgCompetition = $objOrgCompetition;
        $this->ActionParameter = $this->objOrgCompetition;
        $this->blnModified = true;
        if (!is_null($this->objOrgCompetition)) {
            if (!is_null($this->btnDelete)) {
                $this->btnDelete->Style->Display = 'inline';
            }
            //PKey
            $this->intIdOrgCompetition = $this->objOrgCompetition->idOrgCompetition;
            //Is special field!!!!!
            //Do nothing this is a creDate
            $this->intIdAuthUser->Text = $this->objOrgCompetition->idAuthUser;
        } else {
            $this->btnDelete->Style->Display = 'none';
        }
    }
    public function CreateReferenceControls() {
        if (!is_null($this->objOrgCompetition)) {
            if (!is_null($this->objOrgCompetition->idOrg)) {
                $this->lnkViewParentIdOrg = new MJaxLinkButton($this);
                $this->lnkViewParentIdOrg->Text = 'View Org';
                $this->lnkViewParentIdOrg->Href = '/data/editOrgCompetition?' . FFSQS::OrgCompetition_IdOrg . $this->objOrgCompetition->idOrg;
            }
            if (!is_null($this->objOrgCompetition->idCompetition)) {
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = '/data/editOrgCompetition?' . FFSQS::OrgCompetition_IdCompetition . $this->objOrgCompetition->idCompetition;
            }
        }
    }
    public function btnSave_click() {
        if (is_null($this->objOrgCompetition)) {
            //Create a new one
            $this->objOrgCompetition = new OrgCompetition();
        }
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (get_class($this->intIdAuthUser) == 'MJaxBSAutocompleteTextBox') {
            $mixEntity = $this->intIdAuthUser->GetValue();
            if (is_object($mixEntity)) {
                $mixEntity = $mixEntity->__get('idAuthUser');
            }
            $this->objOrgCompetition->idAuthUser = $mixEntity;
        } else {
            $this->objOrgCompetition->idAuthUser = $this->intIdAuthUser->Text;
        }
        $this->objOrgCompetition->Save();
        //Experimental save event trigger
        $this->ActionParameter = $this->objOrgCompetition;
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-save');
    }
    public function btnDelete_click() {
        $this->Confirm('Are you sure you want to delete this?', 'btnDelete_confirm');
    }
    public function btnDelete_confirm() {
        $this->objOrgCompetition->MarkDeleted();
        $this->SetOrgCompetition(null);
        //Experimental delete event trigger
        $this->objForm->TriggerControlEvent($this->strControlId, 'mjax-data-entity-delete');
    }
    public function IsNew() {
        return is_null($this->objOrgCompetition);
    }
    public function InitIdOrgAutocomplete() {
        $this->intIdOrg = new MJaxBSAutocompleteTextBox($this);
        $this->intIdOrg->SetSearchEntity('org');
        $this->intIdOrg->Name = 'idOrg';
        $this->intIdOrg->AddCssClass('input-large');
    }
    public function InitIdCompetitionAutocomplete() {
        $this->intIdCompetition = new MJaxBSAutocompleteTextBox($this);
        $this->intIdCompetition->SetSearchEntity('competition');
        $this->intIdCompetition->Name = 'idCompetition';
        $this->intIdCompetition->AddCssClass('input-large');
    }
}
?>