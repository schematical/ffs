<?php
class landing extends FFSParentCoachLandingForm{
    public function FinishSignup(){
        $objUser = MLCAuthDriver::User();
        foreach($this->arrAtheletes as $objAthelete){
            $objAthelete->IdOrg = $this->objOrg->IdOrg;
            $objAthelete->Save();
            $objUser->AddRoll(FFSRoll::PARENT, $objAthelete);
        }
        $this->Redirect('/parent/index');
    }
}
landing::Run('landing'); ?>