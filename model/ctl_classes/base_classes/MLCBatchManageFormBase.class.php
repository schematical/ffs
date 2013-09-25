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
* - lstMLCBatch_editInit()
* - lstMLCBatch_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - MLCBatchManageFormBase extends FFSForm
*/
class MLCBatchManageFormBase extends FFSForm {
    public $lstMLCBatchs = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdBatch = MLCApplication::QS(FFSQS::MLCBatch_IdBatch);
        if (!is_null($intIdBatch)) {
            $arrAndConditions[] = sprintf('MLCBatch.idBatch = %s', $intIdBatch);
        }
        $strJobName = MLCApplication::QS(FFSQS::MLCBatch_JobName);
        if (!is_null($strJobName)) {
            $arrAndConditions[] = sprintf('MLCBatch.jobName LIKE "%s%%"', $strJobName);
        }
        if (count($arrAndConditions) >= 1) {
            $arrMLCBatchs = MLCBatch::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrMLCBatchs = array();
        }
        return $arrMLCBatchs;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new MLCBatchSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtMLCBatch = $this->AddWidget('Select MLCBatch', 'icon-select', $this->pnlSelect);
        $wgtMLCBatch->AddCssClass('span6');
        return $wgtMLCBatch;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrMLCBatchs = $this->pnlSelect->GetValue();
        if (count($arrMLCBatchs) == 1) {
            $this->pnlEdit->SetMLCBatch($arrMLCBatchs[0]);
            foreach ($this->lstMLCBatchs as $objRow) {
                if ($objRow->ActionParameter == $arrMLCBatchs[0]->IdBatch) {
                    $this->lstMLCBatchs->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstMLCBatchs);
        //}
        $this->lstMLCBatchs->RemoveAllChildControls();
        $this->lstMLCBatchs->SetDataEntites($arrMLCBatchs);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objMLCBatch = null) {
        $this->pnlEdit = new MLCBatchEditPanel($this, $objMLCBatch);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtMLCBatch = $this->AddWidget(((is_null($objMLCBatch)) ? 'Create MLCBatch' : 'Edit MLCBatch') , 'icon-edit', $this->pnlEdit);
        $wgtMLCBatch->AddCssClass('span6');
        return $wgtMLCBatch;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objMLCBatch) {
        $pnlRow = $this->UpdateTable($objMLCBatch);
        $this->ScrollTo($pnlRow);
        $this->pnlEdit->SetMLCBatch(null);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objMLCBatch) {
        $this->lstMLCBatchs->SelectedRow->Remove();
        $this->lstMLCBatchs->SelectedRow = null;
    }
    public function InitList($arrMLCBatchs) {
        $this->lstMLCBatchs = new MLCBatchListPanel($this, $arrMLCBatchs);
        $this->lstMLCBatchs->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstMLCBatch_editInit'));
        $this->lstMLCBatchs->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstMLCBatch_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstMLCBatchs->InitRemoveButtons();
            $this->lstMLCBatchs->InitEditControls();
            $this->lstMLCBatchs->AddEmptyRow();
        } else {
            $this->lstMLCBatchs->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtMLCBatch = $this->AddWidget('MLCBatchs', 'icon-ul', $this->lstMLCBatchs);
        $wgtMLCBatch->AddCssClass('span12');
        return $wgtMLCBatch;
    }
    public function lstMLCBatch_editInit() {
        //_dv($this->lstMLCBatchs->SelectedRow);
        
    }
    public function lstMLCBatch_editSave() {
        $objMLCBatch = MLCBatch::LoadById($this->lstMLCBatchs->SelectedRow->ActionParameter);
        if (is_null($objMLCBatch)) {
            $objMLCBatch = new MLCBatch();
        }
        $objMLCBatch->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstMLCBatchs->SelectedRow->UpdateEntity($objMLCBatch);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetMLCBatch(MLCBatch::LoadById($strActionParameter));
        $this->lstMLCBatchs->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objMLCBatch) {
        //_dv($objMLCBatch);
        if (!is_null($this->lstMLCBatchs->SelectedRow)) {
            //This already exists
            $this->lstMLCBatchs->SelectedRow->UpdateEntity($objMLCBatch);
            $objRow = $this->lstMLCBatchs->SelectedRow;
            $this->lstMLCBatchs->SelectedRow = null;
        } else {
            $objRow = $this->lstMLCBatchs->AddRow($objMLCBatch);
        }
        $this->lstMLCBatchs->RefreshControls();
        return $objRow;
    }
}
