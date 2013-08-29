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
* - lnkViewDevice_click()
* - lnkViewSession_click()
* - lstAssignment_editInit()
* - lstAssignment_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - AssignmentManageFormBase extends FFSForm
*/
class AssignmentManageFormBase extends FFSForm {
    public $lstAssignments = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdAssignment = MLCApplication::QS(FFSQS::Assignment_IdAssignment);
        if (!is_null($intIdAssignment)) {
            $arrAndConditions[] = sprintf('idAssignment = %s', $intIdAssignment);
        }
        $intIdDevice = MLCApplication::QS(FFSQS::Assignment_IdDevice);
        if (!is_null($intIdDevice)) {
            $arrAndConditions[] = sprintf('idDevice = %s', $intIdDevice);
        }
        $intIdSession = MLCApplication::QS(FFSQS::Assignment_IdSession);
        if (!is_null($intIdSession)) {
            $arrAndConditions[] = sprintf('idSession = %s', $intIdSession);
        }
        $strEvent = MLCApplication::QS(FFSQS::Assignment_Event);
        if (!is_null($strEvent)) {
            $arrAndConditions[] = sprintf('event LIKE "%s%%"', $strEvent);
        }
        $strApartatus = MLCApplication::QS(FFSQS::Assignment_Apartatus);
        if (!is_null($strApartatus)) {
            $arrAndConditions[] = sprintf('apartatus LIKE "%s%%"', $strApartatus);
        }
        if (count($arrAndConditions) >= 1) {
            $arrAssignments = Assignment::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrAssignments = array();
        }
        return $arrAssignments;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new AssignmentSelectPanel($this);
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtAssignment = $this->AddWidget('Select Assignment', 'icon-select', $this->pnlSelect);
        $wgtAssignment->AddCssClass('span6');
        return $wgtAssignment;
    }
    public function InitEditPanel($objAssignment = null) {
        $this->pnlEdit = new AssignmentEditPanel($this, $objAssignment);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtAssignment = $this->AddWidget(((is_null($objAssignment)) ? 'Create Assignment' : 'Edit Assignment') , 'icon-edit', $this->pnlEdit);
        $wgtAssignment->AddCssClass('span6');
        return $wgtAssignment;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objAssignment) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objAssignment) {
    }
    public function InitList($arrAssignments) {
        $this->lstAssignments = new AssignmentListPanel($this, $arrAssignments);
        $this->lstAssignments->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstAssignment_editInit'));
        $this->lstAssignments->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstAssignment_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstAssignments->InitRemoveButtons();
            $this->lstAssignments->InitEditControls();
            $this->lstAssignments->AddEmptyRow();
        } else {
            $this->lstAssignments->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $this->lstAssignments->InitRowControl('idDevice', 'View Device', $this, 'lnkViewDevice_click');
        $this->lstAssignments->InitRowControl('idSession', 'View Session', $this, 'lnkViewSession_click');
        $wgtAssignment = $this->AddWidget('Assignments', 'icon-ul', $this->lstAssignments);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstAssignments);
        }
        return $wgtAssignment;
    }
    public function lnkViewDevice_click($strFormId, $strControlId, $strActionParameter) {
        $intIdDevice = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdDevice;
        $this->Redirect('/data/editDevice', array(
            FFSQS::Device_IdDevice => $intIdDevice
        ));
    }
    public function lnkViewSession_click($strFormId, $strControlId, $strActionParameter) {
        $intIdSession = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdSession;
        $this->Redirect('/data/editSession', array(
            FFSQS::Session_IdSession => $intIdSession
        ));
    }
    public function lstAssignment_editInit() {
        //_dv($this->lstAssignments->SelectedRow);
        
    }
    public function lstAssignment_editSave() {
        $objAssignment = Assignment::LoadById($this->lstAssignments->SelectedRow->ActionParameter);
        if (is_null($objAssignment)) {
            $objAssignment = new Assignment();
        }
        $objAssignment->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstAssignments->SelectedRow->UpdateEntity($objAssignment);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetAssignment(Assignment::LoadById($strActionParameter));
        $this->lstAssignments->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objAssignment) {
        //_dv($objAssignment);
        if (!is_null($this->lstAssignments->SelectedRow)) {
            //This already exists
            $this->lstAssignments->SelectedRow->UpdateEntity($objAssignment);
            $this->ScrollTo($this->lstAssignments->SelectedRow);
            $this->lstAssignments->SelectedRow = null;
        } else {
            $objRow = $this->lstAssignments->AddRow($objAssignment);
        }
    }
}
