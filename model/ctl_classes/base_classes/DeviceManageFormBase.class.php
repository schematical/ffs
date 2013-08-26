<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
* - pnlEdit_save()
* - pnlEdit_delete()
* - InitList()
* - lstDevice_editInit()
* - lstDevice_editSave()
* Classes list:
* - DeviceManageFormBase extends FFSForm
*/
class DeviceManageFormBase extends FFSForm {
    public $lstDevices = null;
    public $pnlEdit = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->blnSkipMainWindowRender = true;
    }
    public function InitEditPanel($objDevice = null) {
        $this->pnlEdit = new DeviceEditPanel($this, $objDevice);
        $this->pnlEdit->AddAction(new MJaxDataEntitySaveEvent() , new MJaxServerControlAction($this, 'pnlEdit_save'));
        $this->pnlEdit->AddAction(new MJaxDataEntityDeleteEvent() , new MJaxServerControlAction($this, 'pnlEdit_delete'));
        $wgtDevice = $this->AddWidget(((is_null($objDevice)) ? 'Create Device' : 'Edit Device') , 'icon-edit', $this->pnlEdit);
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
        $wgtDevice = $this->AddWidget('Devices', 'icon-ul', $this->lstDevices);
        return $wgtDevice;
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
}
