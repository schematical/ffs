<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - InitEditPanel()
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
        $this->AddWidget(((is_null($objDevice)) ? 'Create Device' : 'Edit Device') , 'icon-edit', $this->pnlEdit);
    }
    public function InitList($arrDevices) {
        $this->lstDevices = new DeviceListPanel($this, $arrDevices);
        $this->lstDevices->AddAction(new MJaxTableEditInitEvent() , new MJaxServerControlAction($this, 'lstDevice_editInit'));
        $this->lstDevices->AddAction(new MJaxTableEditSaveEvent() , new MJaxServerControlAction($this, 'lstDevice_editSave'));
        $this->AddWidget('Devices', 'icon-ul', $this->lstDevices);
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
