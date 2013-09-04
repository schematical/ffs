<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AtheleteEditPanelBase.class.php");
class AtheleteEditPanel extends AtheleteEditPanelBase {

    public function CreateFieldControls(){
        parent::CreateFieldControls();
        $this->dttBirthDate->DateOnly();

        //TODO: Remove following
        $this->strMemType->Attr('readonly','readonly');
        $this->strMemType->Text = 'USAG';//FOR NOW


        $this->intIdOrg = new OrgSelectPanel($this);
    }
    public function btnSave_click() {
        if (is_null($this->objAthelete)) {
            //Create a new one
            $this->objAthelete = new Athelete();
        }
        if(!is_null($this->intIdOrg)){
            $arrOrgs = $this->intIdOrg->GetValue();
            $objOrg = $arrOrgs[0];
            if(
                (is_null($objOrg)) ||

                (!($objOrg instanceof Org))
            ){
                return $this->intIdOrg->Alert('Must chose a valid Gym');
            }
            $this->objAthelete->IdOrg =$objOrg->IdOrg;

        }
        parent::btnSave_click();
    }
}


?>