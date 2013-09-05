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
* - lstTrackingEvent_editInit()
* - lstTrackingEvent_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - TrackingEventManageFormBase extends FFSForm
*/
class TrackingEventManageFormBase extends FFSForm {
    public $lstTrackingEvents = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdTrackingEvent = MLCApplication::QS(FFSQS::TrackingEvent_IdTrackingEvent);
        if (!is_null($intIdTrackingEvent)) {
            $arrAndConditions[] = sprintf('idTrackingEvent = %s', $intIdTrackingEvent);
        }
        $strName = MLCApplication::QS(FFSQS::TrackingEvent_Name);
        if (!is_null($strName)) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $strName);
        }
        $strValue = MLCApplication::QS(FFSQS::TrackingEvent_Value);
        if (!is_null($strValue)) {
            $arrAndConditions[] = sprintf('value LIKE "%s%%"', $strValue);
        }
        $intIdSession = MLCApplication::QS(FFSQS::TrackingEvent_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('idSession = %s', $intIdSession);
        }
        $strApp = MLCApplication::QS(FFSQS::TrackingEvent_App);
        if (!is_null($strApp)) {
            $arrAndConditions[] = sprintf('app LIKE "%s%%"', $strApp);
        }
        if (count($arrAndConditions) >= 1) {
            $arrTrackingEvents = TrackingEvent::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrTrackingEvents = array();
        }
        return $arrTrackingEvents;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new TrackingEventSelectPanel($this);
        $this->pnlSelect->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'pnlSelect_change'));
        $wgtTrackingEvent = $this->AddWidget('Select TrackingEvent', 'icon-select', $this->pnlSelect);
        $wgtTrackingEvent->AddCssClass('span6');
        return $wgtTrackingEvent;
    }
    public function pnlSelect_change($strFormId, $strControlId, $mixActionParameter) {
        $arrTrackingEvents = $this->pnlSelect->GetValue();
        if (count($arrTrackingEvents) == 1) {
            $this->pnlEdit->SetTrackingEvent($arrTrackingEvents[0]);
            foreach ($this->lstTrackingEvents as $objRow) {
                if ($objRow->ActionParameter == $arrTrackingEvents[0]->IdTrackingEvent) {
                    $this->lstTrackingEvents->SelectedRow = $objRow;
                }
            }
            $this->ScrollTo($this->pnlEdit);
        } else {
            $this->ScrollTo($this->lstTrackingEvents);
        }
        $this->lstTrackingEvents->RemoveAllChildControls();
        $this->lstTrackingEvents->SetDataEntites($arrTrackingEvents);
        //TODO: Remeber to add check lists for assoc or relationship tables
        
    }
    public function InitEditPanel($objTrackingEvent = null) {
        $this->pnlEdit = new TrackingEventEditPanel($this, $objTrackingEvent);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtTrackingEvent = $this->AddWidget(((is_null($objTrackingEvent)) ? 'Create TrackingEvent' : 'Edit TrackingEvent') , 'icon-edit', $this->pnlEdit);
        $wgtTrackingEvent->AddCssClass('span6');
        return $wgtTrackingEvent;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objTrackingEvent) {
        $this->UpdateTable($objTrackingEvent);
        $this->ScrollTo($this->lstTrackingEvents->SelectedRow);
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objTrackingEvent) {
        $this->lstTrackingEvents->SelectedRow->Remove();
        $this->lstTrackingEvents->SelectedRow = null;
    }
    public function InitList($arrTrackingEvents) {
        $this->lstTrackingEvents = new TrackingEventListPanel($this, $arrTrackingEvents);
        $this->lstTrackingEvents->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstTrackingEvent_editInit'));
        $this->lstTrackingEvents->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstTrackingEvent_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstTrackingEvents->InitRemoveButtons();
            $this->lstTrackingEvents->InitEditControls();
            $this->lstTrackingEvents->AddEmptyRow();
        } else {
            $this->lstTrackingEvents->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $wgtTrackingEvent = $this->AddWidget('TrackingEvents', 'icon-ul', $this->lstTrackingEvents);
        $wgtTrackingEvent->AddCssClass('span12');
        return $wgtTrackingEvent;
    }
    public function lstTrackingEvent_editInit() {
        //_dv($this->lstTrackingEvents->SelectedRow);
        
    }
    public function lstTrackingEvent_editSave() {
        $objTrackingEvent = TrackingEvent::LoadById($this->lstTrackingEvents->SelectedRow->ActionParameter);
        if (is_null($objTrackingEvent)) {
            $objTrackingEvent = new TrackingEvent();
        }
        $objTrackingEvent->IdCompetition = FFSForm::Competition()->IdCompetition;
        $this->lstTrackingEvents->SelectedRow->UpdateEntity($objTrackingEvent);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetTrackingEvent(TrackingEvent::LoadById($strActionParameter));
        $this->lstTrackingEvents->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objTrackingEvent) {
        //_dv($objTrackingEvent);
        if (!is_null($this->lstTrackingEvents->SelectedRow)) {
            //This already exists
            $this->lstTrackingEvents->SelectedRow->UpdateEntity($objTrackingEvent);
            $this->lstTrackingEvents->SelectedRow = null;
        } else {
            $objRow = $this->lstTrackingEvents->AddRow($objTrackingEvent);
        }
    }
}
