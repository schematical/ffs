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
            $arrAndConditions[] = sprintf('Session.idSession = %s', $intIdSession);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::Session_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $arrAndConditions[] = sprintf('Session.idCompetition = %s', $intIdCompetition);
        }
        $strName = MLCApplication::QS(FFSQS::Session_Name);
        if (!is_null($strName)) {
            $arrAndConditions[] = sprintf('Session.name LIKE "%s%%"', $strName);
        }
        $strEquipmentSet = MLCApplication::QS(FFSQS::Session_EquipmentSet);
        if (!is_null($strEquipmentSet)) {
            $arrAndConditions[] = sprintf('Session.equipmentSet LIKE "%s%%"', $strEquipmentSet);
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
        $this->pnlSelect->AddAction(new MJaxBSAutocompleteSelectEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtSession = $this->AddWidget('Select Session', 'icon-select', $this->pnlSelect);
        $wgtSession->AddCssClass('span6');
        return $wgtSession;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrSessions = $this->pnlSelect->GetValue();
        if (count($arrSessions) == 1) {
            $this->pnlEdit->SetSession($arrSessions[0]);
            foreach ($this->lstSessions as $objRow) {
                if ($objRow->ActionParameter == $arrSessions[0]->IdSession) {
                    $this->lstSessions->SelectedRow = $objRow;
                }
            }
            //$this->ScrollTo($this->pnlEdit);
            
        } //else{
        $this->ScrollTo($this->lstSessions);
        //}
        $this->lstSessions->RemoveAllChildControls();
        $this->lstSessions->SetDataEntites($arrSessions);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objSession = null) {
        $this->pnlEdit = new SessionEditPanel($this, $objSession);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtSession = $this->AddWidget(((is_null($objSession)) ? 'Create Session' : 'Edit Session') , 'icon-edit', $this->pnlEdit);
        $wgtSession->AddCssClass('span6');
        return $wgtSession;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objSession) {
        $pnlRow = $this->UpdateTable($objSession);
        $this->ScrollTo($pnlRow);
        $this->pnlEdit->SetSession(null);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objSession) {
        $this->lstSessions->SelectedRow->Remove();
        $this->lstSessions->SelectedRow = null;
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
        $wgtSession = $this->AddWidget('Sessions', 'icon-ul', $this->lstSessions);
        $wgtSession->AddCssClass('span12');
        return $wgtSession;
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
            $objRow = $this->lstSessions->SelectedRow;
            $this->lstSessions->SelectedRow = null;
        } else {
            $objRow = $this->lstSessions->AddRow($objSession);
        }
        $this->lstSessions->RefreshControls();
        return $objRow;
    }
}
