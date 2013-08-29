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
* - lnkViewSessions_click()
* - lnkViewOrg_click()
* - lstCompetition_editInit()
* - lstCompetition_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - CompetitionManageFormBase extends FFSForm
*/
class CompetitionManageFormBase extends FFSForm {
    public $lstCompetitions = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdCompetition = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('idCompetition = %s', $intIdCompetition);
        }
        $strName = MLCApplication::QS(FFSQS::Competition_Name);
        if (!is_null($strName)) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $strName);
        }
        $intIdOrg = MLCApplication::QS(FFSQS::Competition_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('idOrg = %s', $intIdOrg);
        }
        $strNamespace = MLCApplication::QS(FFSQS::Competition_Namespace);
        if (!is_null($strNamespace)) {
            $arrAndConditions[] = sprintf('namespace LIKE "%s%%"', $strNamespace);
        }
        if (count($arrAndConditions) >= 1) {
            $arrCompetitions = Competition::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrCompetitions = array();
        }
        return $arrCompetitions;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new CompetitionSelectPanel($this);
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtCompetition = $this->AddWidget('Select Competition', 'icon-select', $this->pnlSelect);
        $wgtCompetition->AddCssClass('span6');
        return $wgtCompetition;
    }
    public function InitEditPanel($objCompetition = null) {
        $this->pnlEdit = new CompetitionEditPanel($this, $objCompetition);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtCompetition = $this->AddWidget(((is_null($objCompetition)) ? 'Create Competition' : 'Edit Competition') , 'icon-edit', $this->pnlEdit);
        $wgtCompetition->AddCssClass('span6');
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
        if ($this->blnInlineEdit) {
            $this->lstCompetitions->InitRemoveButtons();
            $this->lstCompetitions->InitEditControls();
            $this->lstCompetitions->AddEmptyRow();
        } else {
            $this->lstCompetitions->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $this->lstCompetitions->InitRowControl('view_Sessions', 'View Sessions', $this, 'lnkViewSessions_click');
        $this->lstCompetitions->InitRowControl('idOrg', 'View Org', $this, 'lnkViewOrg_click');
        $wgtCompetition = $this->AddWidget('Competitions', 'icon-ul', $this->lstCompetitions);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstCompetitions);
        }
        return $wgtCompetition;
    }
    public function lnkViewSessions_click($strFormId, $strControlId, $strActionParameter) {
        $this->Redirect('/data/editSession', array(
            FFSQS::Competition_IdCompetition => $strActionParameter
        ));
    }
    public function lnkViewOrg_click($strFormId, $strControlId, $strActionParameter) {
        $intIdOrg = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdOrg;
        $this->Redirect('/data/editOrg', array(
            FFSQS::Org_IdOrg => $intIdOrg
        ));
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
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetCompetition(Competition::LoadById($strActionParameter));
        $this->lstCompetitions->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objCompetition) {
        //_dv($objCompetition);
        if (!is_null($this->lstCompetitions->SelectedRow)) {
            //This already exists
            $this->lstCompetitions->SelectedRow->UpdateEntity($objCompetition);
            $this->ScrollTo($this->lstCompetitions->SelectedRow);
            $this->lstCompetitions->SelectedRow = null;
        } else {
            $objRow = $this->lstCompetitions->AddRow($objCompetition);
        }
    }
}
