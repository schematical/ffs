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
* - lstOrgCompetition_editInit()
* - lstOrgCompetition_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - OrgCompetitionManageFormBase extends FFSForm
*/
class OrgCompetitionManageFormBase extends FFSForm {
    public $lstOrgCompetitions = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdOrgCompetition = MLCApplication::QS(FFSQS::OrgCompetition_IdOrgCompetition);
        if (!is_null($intIdOrgCompetition)) {
            $arrAndConditions[] = sprintf('OrgCompetition_rel.idOrgCompetition = %s', $intIdOrgCompetition);
        }
        $intIdOrg = MLCApplication::QS(FFSQS::OrgCompetition_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('OrgCompetition_rel.idOrg = %s', $intIdOrg);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::OrgCompetition_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('OrgCompetition_rel.idCompetition = %s', $intIdCompetition);
        }
        if (count($arrAndConditions) >= 1) {
            $arrOrgCompetitions = OrgCompetition::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrOrgCompetitions = array();
        }
        return $arrOrgCompetitions;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new OrgCompetitionSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtOrgCompetition = $this->AddWidget('Select OrgCompetition', 'icon-select', $this->pnlSelect);
        $wgtOrgCompetition->AddCssClass('span6');
        return $wgtOrgCompetition;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrOrgCompetitions = $this->pnlSelect->GetValue();
        if (count($arrOrgCompetitions) == 1) {
            $this->pnlEdit->SetOrgCompetition($arrOrgCompetitions[0]);
            foreach ($this->lstOrgCompetitions as $objRow) {
                if ($objRow->ActionParameter == $arrOrgCompetitions[0]->IdOrgCompetition) {
                    $this->lstOrgCompetitions->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstOrgCompetitions);
        //}
        $this->lstOrgCompetitions->RemoveAllChildControls();
        $this->lstOrgCompetitions->SetDataEntites($arrOrgCompetitions);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objOrgCompetition = null) {
        $this->pnlEdit = new OrgCompetitionEditPanel($this, $objOrgCompetition);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtOrgCompetition = $this->AddWidget(((is_null($objOrgCompetition)) ? 'Create OrgCompetition' : 'Edit OrgCompetition') , 'icon-edit', $this->pnlEdit);
        $wgtOrgCompetition->AddCssClass('span6');
        return $wgtOrgCompetition;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objOrgCompetition) {
        $pnlRow = $this->UpdateTable($objOrgCompetition);
        $this->ScrollTo($pnlRow);
        $this->pnlEdit->SetOrgCompetition(null);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objOrgCompetition) {
        $this->lstOrgCompetitions->SelectedRow->Remove();
        $this->lstOrgCompetitions->SelectedRow = null;
    }
    public function InitList($arrOrgCompetitions) {
        $this->lstOrgCompetitions = new OrgCompetitionListPanel($this, $arrOrgCompetitions);
        $this->lstOrgCompetitions->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstOrgCompetition_editInit'));
        $this->lstOrgCompetitions->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstOrgCompetition_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstOrgCompetitions->InitRemoveButtons();
            $this->lstOrgCompetitions->InitEditControls();
            $this->lstOrgCompetitions->AddEmptyRow();
        } else {
            $this->lstOrgCompetitions->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtOrgCompetition = $this->AddWidget('OrgCompetitions', 'icon-ul', $this->lstOrgCompetitions);
        $wgtOrgCompetition->AddCssClass('span12');
        return $wgtOrgCompetition;
    }
    public function lstOrgCompetition_editInit() {
        //_dv($this->lstOrgCompetitions->SelectedRow);
        
    }
    public function lstOrgCompetition_editSave() {
        $objOrgCompetition = OrgCompetition::LoadById($this->lstOrgCompetitions->SelectedRow->ActionParameter);
        if (is_null($objOrgCompetition)) {
            $objOrgCompetition = new OrgCompetition();
        }
        $objOrgCompetition->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstOrgCompetitions->SelectedRow->UpdateEntity($objOrgCompetition);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetOrgCompetition(OrgCompetition::LoadById($strActionParameter));
        $this->lstOrgCompetitions->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objOrgCompetition) {
        //_dv($objOrgCompetition);
        if (!is_null($this->lstOrgCompetitions->SelectedRow)) {
            //This already exists
            $this->lstOrgCompetitions->SelectedRow->UpdateEntity($objOrgCompetition);
            $objRow = $this->lstOrgCompetitions->SelectedRow;
            $this->lstOrgCompetitions->SelectedRow = null;
        } else {
            $objRow = $this->lstOrgCompetitions->AddRow($objOrgCompetition);
        }
        $this->lstOrgCompetitions->RefreshControls();
        return $objRow;
    }
}
