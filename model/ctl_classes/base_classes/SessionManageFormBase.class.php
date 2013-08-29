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
* - lnkViewResults_click()
* - lnkViewCompetition_click()
* - lstSession_editInit()
* - lstSession_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - SessionManageFormBase extends FFSForm
*/
class SessionManageFormBase extends FFSForm {
    public $lstSessions = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdSession = MLCApplication::QS(FFSQS::Session_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('idSession = %s', $intIdSession);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::Session_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('idCompetition = %s', $intIdCompetition);
        }
        $strName = MLCApplication::QS(FFSQS::Session_Name);
        if (!is_null($strName)) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $strName);
        }
        $strEquipmentSet = MLCApplication::QS(FFSQS::Session_EquipmentSet);
        if (!is_null($strEquipmentSet)) {
            $arrAndConditions[] = sprintf('equipmentSet LIKE "%s%%"', $strEquipmentSet);
        }
        if (count($arrAndConditions) >= 1) {
            $arrSessions = Session::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrSessions = array();
        }
        return $arrSessions;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new SessionSelectPanel($this);
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtSession = $this->AddWidget('Select Session', 'icon-select', $this->pnlSelect);
        $wgtSession->AddCssClass('span6');
        return $wgtSession;
    }
    public function InitEditPanel($objSession = null) {
        $this->pnlEdit = new SessionEditPanel($this, $objSession);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtSession = $this->AddWidget(((is_null($objSession)) ? 'Create Session' : 'Edit Session') , 'icon-edit', $this->pnlEdit);
        $wgtSession->AddCssClass('span6');
        return $wgtSession;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objSession) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objSession) {
    }
    public function InitList($arrSessions) {
        $this->lstSessions = new SessionListPanel($this, $arrSessions);
        $this->lstSessions->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstSession_editInit'));
        $this->lstSessions->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstSession_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstSessions->InitRemoveButtons();
            $this->lstSessions->InitEditControls();
            $this->lstSessions->AddEmptyRow();
        } else {
            $this->lstSessions->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $this->lstSessions->InitRowControl('view_Results', 'View Results', $this, 'lnkViewResults_click');
        $this->lstSessions->InitRowControl('idCompetition', 'View Competition', $this, 'lnkViewCompetition_click');
        $wgtSession = $this->AddWidget('Sessions', 'icon-ul', $this->lstSessions);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstSessions);
        }
        return $wgtSession;
    }
    public function lnkViewResults_click($strFormId, $strControlId, $strActionParameter) {
        $this->Redirect('/data/editResult', array(
            FFSQS::Session_IdSession => $strActionParameter
        ));
    }
    public function lnkViewCompetition_click($strFormId, $strControlId, $strActionParameter) {
        $intIdCompetition = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdCompetition;
        $this->Redirect('/data/editCompetition', array(
            FFSQS::Competition_IdCompetition => $intIdCompetition
        ));
    }
    public function lstSession_editInit() {
        //_dv($this->lstSessions->SelectedRow);
        
    }
    public function lstSession_editSave() {
        $objSession = Session::LoadById($this->lstSessions->SelectedRow->ActionParameter);
        if (is_null($objSession)) {
            $objSession = new Session();
        }
        $objSession->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstSessions->SelectedRow->UpdateEntity($objSession);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetSession(Session::LoadById($strActionParameter));
        $this->lstSessions->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objSession) {
        //_dv($objSession);
        if (!is_null($this->lstSessions->SelectedRow)) {
            //This already exists
            $this->lstSessions->SelectedRow->UpdateEntity($objSession);
            $this->ScrollTo($this->lstSessions->SelectedRow);
            $this->lstSessions->SelectedRow = null;
        } else {
            $objRow = $this->lstSessions->AddRow($objSession);
        }
    }
}
