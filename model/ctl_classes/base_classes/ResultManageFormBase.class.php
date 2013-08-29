<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - Query()
* - InitSelectPanel()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lnkViewSession_click()
* - lnkViewAthelete_click()
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
            $arrAndConditions[] = sprintf('idResult = %s', $intIdResult);
        }
        $intIdSession = MLCApplication::QS(FFSQS::Result_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('idSession = %s', $intIdSession);
        }
        $intIdAthelete = MLCApplication::QS(FFSQS::Result_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('idAthelete = %s', $intIdAthelete);
        }
        $strScore = MLCApplication::QS(FFSQS::Result_Score);
        if (!is_null($strScore)) {
            $arrAndConditions[] = sprintf('score LIKE "%s%%"', $strScore);
        }
        $strJudge = MLCApplication::QS(FFSQS::Result_Judge);
        if (!is_null($strJudge)) {
            $arrAndConditions[] = sprintf('judge LIKE "%s%%"', $strJudge);
        }
        $strEvent = MLCApplication::QS(FFSQS::Result_Event);
        if (!is_null($strEvent)) {
            $arrAndConditions[] = sprintf('event LIKE "%s%%"', $strEvent);
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
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtResult = $this->AddWidget('Select Result', 'icon-select', $this->pnlSelect);
        $wgtResult->AddCssClass('span6');
        return $wgtResult;
    }
    public function InitEditPanel($objResult = null) {
        $this->pnlEdit = new ResultEditPanel($this, $objResult);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtResult = $this->AddWidget(((is_null($objResult)) ? 'Create Result' : 'Edit Result') , 'icon-edit', $this->pnlEdit);
        $wgtResult->AddCssClass('span6');
        return $wgtResult;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objResult) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objResult) {
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
        $this->lstResults->InitRowControl('idSession', 'View Session', $this, 'lnkViewSession_click');
        $this->lstResults->InitRowControl('idAthelete', 'View Athelete', $this, 'lnkViewAthelete_click');
        $wgtResult = $this->AddWidget('Results', 'icon-ul', $this->lstResults);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstResults);
        }
        return $wgtResult;
    }
    public function lnkViewSession_click($strFormId, $strControlId, $strActionParameter) {
        $intIdSession = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdSession;
        $this->Redirect('/data/editSession', array(
            FFSQS::Session_IdSession => $intIdSession
        ));
    }
    public function lnkViewAthelete_click($strFormId, $strControlId, $strActionParameter) {
        $intIdAthelete = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdAthelete;
        $this->Redirect('/data/editAthelete', array(
            FFSQS::Athelete_IdAthelete => $intIdAthelete
        ));
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
            $this->ScrollTo($this->lstResults->SelectedRow);
            $this->lstResults->SelectedRow = null;
        } else {
            $objRow = $this->lstResults->AddRow($objResult);
        }
    }
}
