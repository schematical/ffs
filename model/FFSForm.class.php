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
                $this->AddHeaderNav('Add Meet', 'icon-plus-sign')->Href = '/org/competition/editCompetition';

            break;
            case(FFSSection::PARENT):
                //TODO - Add invite/share functionality

            break;
        }
    }
    public function InitAds(){
        $this->pnlFooter = new FFSAdPanel($this);
    }
    public function _searchAthelete($objRoute){
        $strSearch = $_POST['search'];
        $arrAtheletes = Athelete::Query(
            sprintf(
                'WHERE firstName LIKE "%s%%" OR lastName LIKE "%s%%"',
                $strSearch,
                $strSearch
            )
        );

        $arrAtheleteNames = array();
        foreach($arrAtheletes as $intIndex => $objAthelete){
            $arrAtheleteNames[] = $objAthelete->FirstName . ' ' . $objAthelete->LastName;
        }
        //$arrAtheleteNames = array('test', 'toast', 'boast');
        die(
            json_encode(
                $arrAtheleteNames
            )
        );
    }
}