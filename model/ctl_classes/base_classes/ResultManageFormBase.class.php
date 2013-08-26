<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstResult_editInit()
* - lstResult_editSave()
* Classes list:
* - ResultManageFormBase extends FFSForm
*/
class ResultManageFormBase extends FFSForm {
    public $lstResults = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objResult = null) {
        $this->pnlEdit = new ResultEditPanel($this, $objResult);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtResult = $this->AddWidget(((is_null($objResult)) ? 'Create Result' : 'Edit Result') , 'icon-edit', $this->pnlEdit);
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
        $wgtResult = $this->AddWidget('Results', 'icon-ul', $this->lstResults);
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
}
