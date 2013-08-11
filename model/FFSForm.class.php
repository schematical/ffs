<?php
class FFSForm extends MJaxWAdminForm{
    public static $objCompetition = null;
    public static $objOrg = null;
    public static $strSection = null;
    public function Form_Create(){
        parent::Form_Create();

        if(is_null(self::$objOrg)){

            $arrOrgs = MLCAuthDriver::GetRolls(FFSRoll::ORG_MANAGER);
            if(count($arrOrgs) == 0){
                //Do nothing
            }elseif(count($arrOrgs) == 1){
                FFSForm::$objOrg = $arrOrgs[0];
            }else{
                FFSForm::$objOrg = $arrOrgs[0];
            }
        }

        $this->SetUpNavMenu();
        //If not is paid account{
            $this->InitAds();
        //}
    }
    public function SetUpNavMenu(){
        $this->AddHeaderNav('Home', 'icon-home')->Href = '/';
        switch(FFSForm::$strSection){
            case(FFSSection::ORG):
                $this->AddHeaderNav('Add Meet', 'icon-plus-sign')->Href = '/org/editCompetiton.php';
            break;
            case(FFSSection::PARENT):
                //TODO - Add invite/share functionality

            break;
        }
    }
    public function InitAds(){
        $this->pnlFooter = new FFSAdPanel($this);
    }
}