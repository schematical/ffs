<?php
class landing extends FFSParentCoachLandingForm{

    public function Form_Create(){
        parent::Form_Create();
        $objUser = MLCAuthDriver::User();
        if(!is_null($objUser)){
            $this->CPRedirect('/index');
        }
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/landing.tpl.php';

    }
    public function pnlOrg_select(){
        $objOrg = $this->pnlOrg->GetValue();

        if(is_object($objOrg)){
            $arrRolls = MLCAuthDriver::GetUsersByEntity($objOrg, FFSRoll::ORG_MANAGER);
            if(count($arrRolls) > 0){
                //There is already a account set up to manage this account
                return $this->pnlOrg->Alert('There is already an account associated with this Gym. Please<a href"/contactUs">Contact Us</a> if you belive this is an error.');
            }

        }else{
            parent::pnlOrg_select();
        }
    }
    public function FinishSignup(){
        $objUser = MLCAuthDriver::User();
        foreach($this->arrAtheletes as $objAthelete){
            $objAthelete->IdOrg = $this->objOrg->IdOrg;
            $objAthelete->Save();

        }
        $objUser->AddRoll(FFSRoll::ORG_MANAGER, $this->objOrg);
        $this->Redirect('/parent/index');
    }


}

landing::Run('landing');