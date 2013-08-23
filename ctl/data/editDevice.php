<?php
class DeviceManageForm extends DeviceManageFormBase{
    protected $blnInlineEdit = false;
    public function Form_Create(){
        parent::Form_Create();

        $arrDevices = $this->Query();
        $this->InitList($arrDevices);

    }
    public function Query(){
        $arrDevices = Device::Query(
            sprintf(
                'WHERE 1'
            )
         );


        return $arrDevices;
    }
    public function InitList($arrDevices){
        parent::InitList($arrDevices);
        if($this->blnInlineEdit){
            $this->lstDevices->InitRemoveButtons();
            $this->lstDevices->InitEditControls();
            $this->lstDevices->AddEmptyRow();
        }else{
            $this->lstDevices->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );
            $this->InitEditPanel();
        }
    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlEdit->SetDevice(
            Device::LoadById($strActionParameter)
        );
    }
    public function lstDevice_editInit(){
        //_dv($this->lstDevices->SelectedRow);
    }
    public function lstDevice_editSave(){
        $objDevice = Device::LoadById($this->lstDevices->SelectedRow->ActionParameter);
        if(is_null($objDevice)){
            $objDevice = new Device();
        }
        $objDevice->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $this->lstDevices->SelectedRow->UpdateEntity(
            $objDevice
        );
    }

}
DeviceManageForm::Run('DeviceManageForm');