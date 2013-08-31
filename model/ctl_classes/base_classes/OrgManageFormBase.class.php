<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitSelectPanel()
* - pnlSelect_change()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstOrg_editInit()
* - lstOrg_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - OrgManageFormBase extends FFSForm
*/
class OrgManageFormBase extends FFSForm {
    public $lstOrgs = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdOrg = MLCApplication::QS(FFSQS::Org_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('idOrg = %s', $intIdOrg);
        }
        $strNamespace = MLCApplication::QS(FFSQS::Org_Namespace);
        if (!is_null($strNamespace)) {
            $arrAndConditions[] = sprintf('namespace LIKE "%s%%"', $strNamespace);
        }
        $strName = MLCApplication::QS(FFSQS::Org_Name);
        if (!is_null($strName)) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $strName);
        }
        $strClubNum = MLCApplication::QS(FFSQS::Org_ClubNum);
        if (!is_null($strClubNum)) {
            $arrAndConditions[] = sprintf('clubNum LIKE "%s%%"', $strClubNum);
        }
        if (count($arrAndConditions) >= 1) {
            $arrOrgs = Org::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrOrgs = array();
        }
        return $arrOrgs;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new OrgSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtOrg = $this->AddWidget('Select Org', 'icon-select', $this->pnlSelect);
        $wgtOrg->AddCssClass('span6');
        return $wgtOrg;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrOrgs = $this->pnlSelect->GetValue();
        if (count($arrOrgs) == 1) {
            $this->pnlEdit->SetOrg($arrOrgs[0]);
            foreach ($this->lstOrgs as $objRow) {
                if ($objRow->ActionParameter == $arrOrgs[0]->IdOrg) {
                    $this->lstOrgs->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstOrgs);
        //}
        $this->lstOrgs->RemoveAllChildControls();
        $this->lstOrgs->SetDataEntites($arrOrgs);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objOrg = null) {
        $this->pnlEdit = new OrgEditPanel($this, $objOrg);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtOrg = $this->AddWidget(((is_null($objOrg)) ? 'Create Org' : 'Edit Org') , 'icon-edit', $this->pnlEdit);
        $wgtOrg->AddCssClass('span6');
        return $wgtOrg;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objOrg) {
        $this->UpdateTable($objOrg);
        if (!is_null($this->lstOrgs->SelectedRow)) {
            $this->ScrollTo($this->lstOrgs->SelectedRow);
        } else {
            $this->pnlEdit->Alert('Saved!', 'info');
        }
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objOrg) {
        $this->lstOrgs->SelectedRow->Remove();
        $this->lstOrgs->SelectedRow = null;
    }
    public function InitList($arrOrgs) {
        $this->lstOrgs = new OrgListPanel($this, $arrOrgs);
        $this->lstOrgs->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstOrg_editInit'));
        $this->lstOrgs->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstOrg_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstOrgs->InitRemoveButtons();
            $this->lstOrgs->InitEditControls();
            $this->lstOrgs->AddEmptyRow();
        } else {
            $this->lstOrgs->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtOrg = $this->AddWidget('Orgs', 'icon-ul', $this->lstOrgs);
        $wgtOrg->AddCssClass('span12');
        return $wgtOrg;
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
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetOrg(Org::LoadById($strActionParameter));
        $this->lstOrgs->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objOrg) {
        //_dv($objOrg);
        if (!is_null($this->lstOrgs->SelectedRow)) {
            //This already exists
            $this->lstOrgs->SelectedRow->UpdateEntity($objOrg);
            $this->lstOrgs->SelectedRow = null;
        } else {
            $objRow = $this->lstOrgs->AddRow($objOrg);
        }
    }
}
