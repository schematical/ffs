<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - InitList()
* - lstOrg_editInit()
* - lstOrg_editSave()
* Classes list:
* - OrgManageFormBase extends FFSForm
*/
class OrgManageFormBase extends FFSForm {
    public $lstOrgs = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objOrg = null) {
        $this->pnlEdit = new OrgEditPanel($this, $objOrg);
        $this->AddWidget(((is_null($objOrg)) ? 'Create Org' : 'Edit Org') , 'icon-edit', $this->pnlEdit);
    }
    public function InitList($arrOrgs) {
        $this->lstOrgs = new OrgListPanel($this, $arrOrgs);
        $this->lstOrgs->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstOrg_editInit'));
        $this->lstOrgs->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstOrg_editSave'));
        $this->AddWidget('Orgs', 'icon-ul', $this->lstOrgs);
    }
    public function lstOrg_editInit() {
        //_dv($this->lstOrgs->SelectedRow);
        
    }
    public function lstOrg_editSave() {
        $objOrg = Org::LoadById($this->lstOrgs->SelectedRow->ActionParameter);
        if (is_null($objOrg)) {
            $objOrg = new Org();
        }
        $objOrg->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstOrgs->SelectedRow->UpdateEntity($objOrg);
    }
}
