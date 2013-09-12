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
* - lstAthelete_editInit()
* - lstAthelete_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - AtheleteManageFormBase extends FFSForm
*/
class AtheleteManageFormBase extends FFSForm {
    public $lstAtheletes = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('Athelete.idAthelete = %s', $intIdAthelete);
        }
        $intIdOrg = MLCApplication::QS(FFSQS::Athelete_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('Athelete.idOrg = %s', $intIdOrg);
        }
        $strFirstName = MLCApplication::QS(FFSQS::Athelete_FirstName);
        if (!is_null($strFirstName)) {
            $arrAndConditions[] = sprintf('Athelete.firstName LIKE "%s%%"', $strFirstName);
        }
        $strLastName = MLCApplication::QS(FFSQS::Athelete_LastName);
        if (!is_null($strLastName)) {
            $arrAndConditions[] = sprintf('Athelete.lastName LIKE "%s%%"', $strLastName);
        }
        $strMemType = MLCApplication::QS(FFSQS::Athelete_MemType);
        if (!is_null($strMemType)) {
            $arrAndConditions[] = sprintf('Athelete.memType LIKE "%s%%"', $strMemType);
        }
        $strMemId = MLCApplication::QS(FFSQS::Athelete_MemId);
        if (!is_null($strMemId)) {
            $arrAndConditions[] = sprintf('Athelete.memId LIKE "%s%%"', $strMemId);
        }
        $strLevel = MLCApplication::QS(FFSQS::Athelete_Level);
        if (!is_null($strLevel)) {
            $arrAndConditions[] = sprintf('Athelete.level LIKE "%s%%"', $strLevel);
        }
        if (count($arrAndConditions) >= 1) {
            $arrAtheletes = Athelete::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrAtheletes = array();
        }
        return $arrAtheletes;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new AtheleteSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtAthelete = $this->AddWidget('Select Athelete', 'icon-select', $this->pnlSelect);
        $wgtAthelete->AddCssClass('span6');
        return $wgtAthelete;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrAtheletes = $this->pnlSelect->GetValue();
        if (count($arrAtheletes) == 1) {
            $this->pnlEdit->SetAthelete($arrAtheletes[0]);
            foreach ($this->lstAtheletes as $objRow) {
                if ($objRow->ActionParameter == $arrAtheletes[0]->IdAthelete) {
                    $this->lstAtheletes->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstAtheletes);
        //}
        $this->lstAtheletes->RemoveAllChildControls();
        $this->lstAtheletes->SetDataEntites($arrAtheletes);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objAthelete = null) {
        $this->pnlEdit = new AtheleteEditPanel($this, $objAthelete);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtAthelete = $this->AddWidget(((is_null($objAthelete)) ? 'Create Athelete' : 'Edit Athelete') , 'icon-edit', $this->pnlEdit);
        $wgtAthelete->AddCssClass('span6');
        return $wgtAthelete;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objAthelete) {
        $pnlRow = $this->UpdateTable($objAthelete);
        $this->ScrollTo($pnlRow);
        $this->pnlEdit->SetAthelete(null);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objAthelete) {
        $this->lstAtheletes->SelectedRow->Remove();
        $this->lstAtheletes->SelectedRow = null;
    }
    public function InitList($arrAtheletes) {
        $this->lstAtheletes = new AtheleteListPanel($this, $arrAtheletes);
        $this->lstAtheletes->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstAthelete_editInit'));
        $this->lstAtheletes->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstAthelete_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstAtheletes->InitRemoveButtons();
            $this->lstAtheletes->InitEditControls();
            $this->lstAtheletes->AddEmptyRow();
        } else {
            $this->lstAtheletes->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtAthelete = $this->AddWidget('Atheletes', 'icon-ul', $this->lstAtheletes);
        $wgtAthelete->AddCssClass('span12');
        return $wgtAthelete;
    }
    public function lstAthelete_editInit() {
        //_dv($this->lstAtheletes->SelectedRow);
        
    }
    public function lstAthelete_editSave() {
        $objAthelete = Athelete::LoadById($this->lstAtheletes->SelectedRow->ActionParameter);
        if (is_null($objAthelete)) {
            $objAthelete = new Athelete();
        }
        $objAthelete->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAtheletes->SelectedRow->UpdateEntity($objAthelete);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetAthelete(Athelete::LoadById($strActionParameter));
        $this->lstAtheletes->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objAthelete) {
        //_dv($objAthelete);
        if (!is_null($this->lstAtheletes->SelectedRow)) {
            //This already exists
            $this->lstAtheletes->SelectedRow->UpdateEntity($objAthelete);
            $objRow = $this->lstAtheletes->SelectedRow;
            $this->lstAtheletes->SelectedRow = null;
        } else {
            $objRow = $this->lstAtheletes->AddRow($objAthelete);
        }
        $this->lstAtheletes->RefreshControls();
        return $objRow;
    }
}
