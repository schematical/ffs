<?php
class FFSForm extends MJaxWAdminForm{
    public static $objSession = null;
    public static $objCompetition = null;
    public static $objOrg = null;
    public static $strSection = null;
    public $objJsonSearchDriver = null;

    public function Form_Create(){
        parent::Form_Create();
        $this->objJsonSearchDriver = new FFSJsonSearchDriver();
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
        if(!is_null(self::$objCompetition)){
            $intIdSession = MLCApplication::QS(FFSQS::IdSession);
            if(
                (!is_null($intIdSession)) &&
                (is_numeric($intIdSession))
            ){
                FFSForm::$objSession = Session::Query(
                    sprintf(
                        'WHERE idSession = %s AND idCompetition = %s',
                        $intIdSession,
                        FFSForm::$objCompetition->IdCompetition
                    ),
                    true
                );
            }
        }
        $this->SetUpNavMenu();
        //If not is paid account{
            $this->InitAds();
        //}
    }
    public function SearchForAtheletes($strSearch){
        if(!is_numeric($strSearch)){
            $arrAtheletes = Athelete::Query(
                sprintf(
                    'WHERE firstName LIKE "%s%%" or lastName LIKE "%s%%"',
                    strtolower($strSearch),
                    strtolower($strSearch)
                )
            );
        }else{
            $arrAtheletes = Athelete::Query(
                sprintf(
                    'WHERE idAthelete = %s OR memId = %s',
                    strtolower($strSearch),
                    strtolower($strSearch)
                )
            );
        }
    }
    public function SetUpNavMenu(){
        $this->AddHeaderNav('Home', 'icon-home')->Href = '/';

        switch(FFSForm::$strSection){
            case(FFSSection::ORG):

                if(is_null(FFSForm::$objCompetition)){
                    $this->AddHeaderNav('Add Competition', 'icon-plus-sign')->Href = '/org/competition/editCompetition';
                }else{
                    $lnkManageSessions = $this->AddHeaderNav('Manage Sessions', 'icon-calendar');
                    $lnkManageSessions->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageSessions';
                    $arrSessions = Session::LoadCollByIdCompetition(FFSForm::$objCompetition->IdCompetition)->getCollection();
                    foreach($arrSessions as $objSession){
                        //_dv($lnkManageSessions);
                        $lnkManageSessions->AddSubNavLink(
                            $objSession->Name,
                            '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageEnrollments?' . FFSQS::IdSession . '='. $objSession->IdSession
                        );
                    }
                    $this->AddHeaderNav('Invite Gyms', 'icon-building')->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageGyms';
                    $this->AddHeaderNav('Manage Atheletes', 'icon-user')->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageAtheletes';

                    //Probablly don't allow untill meet starts
                    $this->AddHeaderNav('Results', 'icon-trophy')->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/results';

                }

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