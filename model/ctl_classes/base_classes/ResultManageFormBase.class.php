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
* - lstResult_editInit()
* - lstResult_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - ResultManageFormBase extends FFSForm
*/
class ResultManageFormBase extends FFSForm {
    public $lstResults = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdResult = MLCApplication::QS(FFSQS::Result_IdResult);
        if (!is_null($intIdResult)) {
            $arrAndConditions[] = sprintf('Result.idResult = %s', $intIdResult);
        }
        $intIdSession = MLCApplication::QS(FFSQS::Result_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('Result.idSession = %s', $intIdSession);
        }
        $intIdAthelete = MLCApplication::QS(FFSQS::Result_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('Result.idAthelete = %s', $intIdAthelete);
        }
        $strScore = MLCApplication::QS(FFSQS::Result_Score);
        if (!is_null($strScore)) {
            $arrAndConditions[] = sprintf('Result.score LIKE "%s%%"', $strScore);
        }
        $strJudge = MLCApplication::QS(FFSQS::Result_Judge);
        if (!is_null($strJudge)) {
            $arrAndConditions[] = sprintf('Result.judge LIKE "%s%%"', $strJudge);
        }
        $strEvent = MLCApplication::QS(FFSQS::Result_Event);
        if (!is_null($strEvent)) {
            $arrAndConditions[] = sprintf('Result.event LIKE "%s%%"', $strEvent);
        }
        $strStartValue = MLCApplication::QS(FFSQS::Result_StartValue);
        if (!is_null($strStartValue)) {
            $arrAndConditions[] = sprintf('Result.startValue LIKE "%s%%"', $strStartValue);
        }
        if (count($arrAndConditions) >= 1) {
            $arrResults = Result::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrResults = array();
        }
        return $arrResults;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new ResultSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtResult = $this->AddWidget('Select Result', 'icon-select', $this->pnlSelect);
        $wgtResult->AddCssClass('span6');
        return $wgtResult;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrResults = $this->pnlSelect->GetValue();
        if (count($arrResults) == 1) {
            $this->pnlEdit->SetResult($arrResults[0]);
            foreach ($this->lstResults as $objRow) {
                if ($objRow->ActionParameter == $arrResults[0]->IdResult) {
                    $this->lstResults->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstResults);
        //}
        $this->lstResults->RemoveAllChildControls();
        $this->lstResults->SetDataEntites($arrResults);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objResult = null) {
        $this->pnlEdit = new ResultEditPanel($this, $objResult);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtResult = $this->AddWidget(((is_null($objResult)) ? 'Create Result' : 'Edit Result') , 'icon-edit', $this->pnlEdit);
        $wgtResult->AddCssClass('span6');
        return $wgtResult;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objResult) {
        $pnlRow = $this->UpdateTable($objResult);
        $this->ScrollTo($pnlRow);
        $this->pnlEdit->SetResult(null);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objResult) {
        $this->lstResults->SelectedRow->Remove();
        $this->lstResults->SelectedRow = null;
    }
    public function InitList($arrResults) {
        $this->lstResults = new ResultListPanel($this, $arrResults);
        $this->lstResults->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstResult_editInit'));
        $this->lstResults->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstResult_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstResults->InitRemoveButtons();
            $this->lstResults->InitEditControls();
            $this->lstResults->AddEmptyRow();
        } else {
            $this->lstResults->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtResult = $this->AddWidget('Results', 'icon-ul', $this->lstResults);
        $wgtResult->AddCssClass('span12');
        return $wgtResult;
    }
    public function lstResult_editInit() {
        //_dv($this->lstResults->SelectedRow);
        
    }
    public function lstResult_editSave() {
        $objResult = Result::LoadById($this->lstResults->SelectedRow->ActionParameter);
        if (is_null($objResult)) {
            $objResult = new Result();
        }
        $objResult->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstResults->SelectedRow->UpdateEntity($objResult);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetResult(Result::LoadById($strActionParameter));
        $this->lstResults->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objResult) {
        //_dv($objResult);
        if (!is_null($this->lstResults->SelectedRow)) {
            //This already exists
            $this->lstResults->SelectedRow->UpdateEntity($objResult);
            $objRow = $this->lstResults->SelectedRow;
            $this->lstResults->SelectedRow = null;
        } else {
            $objRow = $this->lstResults->AddRow($objResult);
        }
        $this->lstResults->RefreshControls();
        return $objRow;
    }
}
