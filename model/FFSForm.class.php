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
        FFSApplication::Init();


        $this->SetUpNavMenu();
        //If not is paid account{
            $this->InitAds();
        //}
        $this->SetUpBreadcrumbs();
    }
    public function TriggerControlEvent($strControlId, $strEvent){
        FFSApplication::Init();
        parent::TriggerControlEvent($strControlId, $strEvent);
    }
    public function SetUpBreadcrumbs(){
        if(!is_null(FFSForm::$objOrg)){
            $lnkCrumb = $this->pnlBreadcrumb->AddCrumb(
                FFSForm::$objOrg->Name,
                '/'
            );


            if(!is_null(FFSForm::$objCompetition)){
                $lnkCrumb = $this->pnlBreadcrumb->AddCrumb(
                    FFSForm::$objCompetition->Name,
                    '/' . FFSForm::$objCompetition->Namespace .'/org'
                );

                if(!is_null(FFSForm::$objSession)){
                    $lnkCrumb = $this->pnlBreadcrumb->AddCrumb(
                        FFSForm::$objSession->Name,
                        '/' . FFSForm::$objCompetition->Namespace . '/org?' . FFSQS::IdSession . '=' . FFSForm::$objSession->IdSession
                    );
                }
            }
        }


    }

    public function SetUpNavMenu(){
        $this->AddHeaderNav('Home', 'icon-home')->Href = '/';

        switch(FFSForm::$strSection){
            case(FFSSection::ORG):

                if(is_null(FFSForm::$objCompetition)){
                    $lnkManageCompetitions = $this->AddHeaderNav('Competitions', 'icon-flag');

                    $arrCompetitions = FFSApplication::GetActiveCompetitions();
                    foreach($arrCompetitions as $objCompetition){
                        //_dv($lnkManageSessions);
                        $lnkManageCompetitions->AddSubNavLink(
                            $objCompetition->Name,
                            '/' . $objCompetition->Namespace . '/org/competition/index'
                        );
                    }
                    $lnkManageCompetitions->AddSubNavLink(
                        '<i class="icon-plus-sign"></i>Add New Competition',
                        '/org/competition/editCompetition'
                    );
                    $lnkManageCompetitions = $this->AddHeaderNav('Your Athletes', 'icon-user');
                    $lnkManageCompetitions->Href = '/org/manageAthletes';
                }else{
                    $lnkManageSessions = $this->AddHeaderNav('Manage Sessions', 'icon-calendar');
                    $lnkManageSessions->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageSessions';
                    $arrSessions = Session::LoadCollByIdCompetition(FFSForm::$objCompetition->IdCompetition)->getCollection();
                    foreach($arrSessions as $objSession){
                        //_dv($lnkManageSessions);
                        $lnkManageSessions->AddSubNavLink(
                            $objSession->Name,
                            '/' . FFSForm::$objCompetition->Namespace . '/org/competition/sessionDetails?' . FFSQS::IdSession . '='. $objSession->IdSession
                        );
                    }
                    $this->AddHeaderNav('Invite Gyms', 'icon-building')->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageGyms';
                    $this->AddHeaderNav('Manage Athletes', 'icon-user')->Href = '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageAthletes';

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