<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - DeviceManageForm extends DeviceManageFormBase
*/
class DeviceManageForm extends DeviceManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrDevices = $this->Query();
        $objDevice = null;
        if (count($arrDevices) == 1) {
            $objDevice = $arrDevices[0];
        }
        $this->InitEditPanel($objDevice);
        $this->InitList($arrDevices);
    }
}
DeviceManageForm::Run('DeviceManageForm');
