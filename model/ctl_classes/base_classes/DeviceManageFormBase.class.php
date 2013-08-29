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
* - lnkViewAssignments_click()
* - lnkViewOrg_click()
* - lstDevice_editInit()
* - lstDevice_editSave()
* - lnkEdit_click()
* - UpdateTable()
* Classes list:
* - DeviceManageFormBase extends FFSForm
*/
class DeviceManageFormBase extends FFSForm {
    public $lstDevices = null;
    public $pnlEdit = null;
    public $pnlSelect = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function Query() {
        $arrAndConditions = array();
        $intIdDevice = MLCApplication::QS(FFSQS::Device_IdDevice);
        if (!is_null($intIdDevice)) {
            $arrAndConditions[] = sprintf('idDevice = %s', $intIdDevice);
        }
        $strName = MLCApplication::QS(FFSQS::Device_Name);
        if (!is_null($strName)) {
            $arrAndConditions[] = sprintf('name LIKE "%s%%"', $strName);
        }
        $strToken = MLCApplication::QS(FFSQS::Device_Token);
        if (!is_null($strToken)) {
            $arrAndConditions[] = sprintf('token LIKE "%s%%"', $strToken);
        }
        $strInviteEmail = MLCApplication::QS(FFSQS::Device_InviteEmail);
        if (!is_null($strInviteEmail)) {
            $arrAndConditions[] = sprintf('inviteEmail LIKE "%s%%"', $strInviteEmail);
        }
        $intIdOrg = MLCApplication::QS(FFSQS::Device_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('idOrg = %s', $intIdOrg);
        }
        if (count($arrAndConditions) >= 1) {
            $arrDevices = Device::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrDevices = array();
        }
        return $arrDevices;
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new DeviceSelectPanel($this);
        /*$this->pnlEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction($this, 'pnlEdit_save')
            );*/
        $wgtDevice = $this->AddWidget('Select Device', 'icon-select', $this->pnlSelect);
        $wgtDevice->AddCssClass('span6');
        return $wgtDevice;
    }
    public function InitEditPanel($objDevice = null) {
        $this->pnlEdit = new DeviceEditPanel($this, $objDevice);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtDevice = $this->AddWidget(((is_null($objDevice)) ? 'Create Device' : 'Edit Device') , 'icon-edit', $this->pnlEdit);
        $wgtDevice->AddCssClass('span6');
        return $wgtDevice;
    }
    //Fake event holders for now
    public function pnlEdit_save($strFormId, $strControlId, $objDevice) {
    }
    public function pnlEdit_delete($strFormId, $strControlId, $objDevice) {
    }
    public function InitList($arrDevices) {
        $this->lstDevices = new DeviceListPanel($this, $arrDevices);
        $this->lstDevices->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstDevice_editInit'));
        $this->lstDevices->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstDevice_editSave'));
        if ($this->blnInlineEdit) {
            $this->lstDevices->InitRemoveButtons();
            $this->lstDevices->InitEditControls();
            $this->lstDevices->AddEmptyRow();
        } else {
            $this->lstDevices->InitRowControl('edit', 'Edit', $this, 'lnkEdit_click');
        }
        //
        $this->lstDevices->InitRowControl('view_Assignments', 'View Assignments', $this, 'lnkViewAssignments_click');
        $this->lstDevices->InitRowControl('idOrg', 'View Org', $this, 'lnkViewOrg_click');
        $wgtDevice = $this->AddWidget('Devices', 'icon-ul', $this->lstDevices);
        if (!is_null($this->pnlSelect)) {
            $this->pnlSelect->ConnectTable($this->lstDevices);
        }
        return $wgtDevice;
    }
    public function lnkViewAssignments_click($strFormId, $strControlId, $strActionParameter) {
        $this->Redirect('/data/editAssignment', array(
            FFSQS::Device_IdDevice => $strActionParameter
        ));
    }
    public function lnkViewOrg_click($strFormId, $strControlId, $strActionParameter) {
        $intIdOrg = $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdOrg;
        $this->Redirect('/data/editOrg', array(
            FFSQS::Org_IdOrg => $intIdOrg
        ));
    }
    public function lstDevice_editInit() {
        //_dv($this->lstDevices->SelectedRow);
        
    }
    public function lstDevice_editSave() {
        $objDevice = Device::LoadById($this->lstDevices->SelectedRow->ActionParameter);
        if (is_null($objDevice)) {
            $objDevice = new Device();
        }
        $objDevice->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstDevices->SelectedRow->UpdateEntity($objDevice);
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $this->pnlEdit->SetDevice(Device::LoadById($strActionParameter));
        $this->lstDevices->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);
    }
    public function UpdateTable($objDevice) {
        //_dv($objDevice);
        if (!is_null($this->lstDevices->SelectedRow)) {
            //This already exists
            $this->lstDevices->SelectedRow->UpdateEntity($objDevice);
            $this->ScrollTo($this->lstDevices->SelectedRow);
            $this->lstDevices->SelectedRow = null;
        } else {
            $objRow = $this->lstDevices->AddRow($objDevice);
        }
    }
}
