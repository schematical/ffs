<?php

class deviceManager extends FFSForm {
    public $pnlAssignmentList = null;
    public $pnlDeviceAssignment = null;
    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');

        }
        //$arrDevices = Device::LoadCollByIdOrg(FFSForm::Org());

        $arrAssignments = FFSApplication::GetAssignmentsByCompetiton();
        $this->pnlAssignmentList = new AssignmentListPanel($this, $arrAssignments);




        $this->pnlDeviceAssignment = new FFSDeviceAssignmentPanel($this);


        $this->AddWidget('Assign Device','icon-tablet', $this->pnlDeviceAssignment);
        $this->AddWidget('Device Assignments','icon-tablet', $this->pnlAssignmentList);

    }

}
deviceManager::Run('deviceManager');
?>