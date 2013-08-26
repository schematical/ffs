<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstCompetition_editInit()
* - lstCompetition_editSave()
* Classes list:
* - CompetitionManageFormBase extends FFSForm
*/
class CompetitionManageFormBase extends FFSForm {
    public $lstCompetitions = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objCompetition = null) {
        $this->pnlEdit = new CompetitionEditPanel($this, $objCompetition);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtCompetition = $this->AddWidget(((is_null($objCompetition)) ? 'Create Competition' : 'Edit Competition') , 'icon-edit', $this->pnlEdit);
        return $wgtCompetition;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objCompetition) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objCompetition) {
    }
    public function InitList($arrCompetitions) {
        $this->lstCompetitions = new CompetitionListPanel($this, $arrCompetitions);
        $this->lstCompetitions->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstCompetition_editInit'));
        $this->lstCompetitions->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstCompetition_editSave'));
        $wgtCompetition = $this->AddWidget('Competitions', 'icon-ul', $this->lstCompetitions);
        return $wgtCompetition;
    }
    public function lstCompetition_editInit() {
        //_dv($this->lstCompetitions->SelectedRow);
        
    }
    public function lstCompetition_editSave() {
        $objCompetition = Competition::LoadById($this->lstCompetitions->SelectedRow->ActionParameter);
        if (is_null($objCompetition)) {
            $objCompetition = new Competition();
        }
        $objCompetition->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstCompetitions->SelectedRow->UpdateEntity($objCompetition);
    }
}
