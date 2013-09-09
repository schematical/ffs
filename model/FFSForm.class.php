<?php
class FFSForm extends MJaxWAdminForm{
    public static $strSection = null;
    public static $objForm = null;

    public function Form_Create(){
        parent::Form_Create();
        self::$objForm = $this;
        $this->blnSkipMainWindowRender = true;
        $this->objEntityManager = MLCApplication::$objRewriteHandeler->EntityManager;
        if(is_null($this->objEntityManager)){
            $this->objEntityManager = new FFSEntityManager();
        }
        $this->objEntityManager->Populate();


        $this->SetUpNavMenu();
        //If not is paid account{
            $this->InitAds();
        //}
        $this->SetUpBreadcrumbs();
    }
    public function TriggerControlEvent($strControlId, $strEvent){
        self::$objForm = $this;
        parent::TriggerControlEvent($strControlId, $strEvent);
    }
    public function SetUpBreadcrumbs(){
        if(!is_null(FFSForm::Org())){
            $lnkCrumb = $this->pnlBreadcrumb->AddCrumb(
                FFSForm::Org()->Name,
                '/'
            );


            if(!is_null(FFSForm::Competition())){
                $lnkCrumb = $this->pnlBreadcrumb->AddCrumb(
                    FFSForm::Competition()->Name,
                    '/' . FFSForm::Competition()->Namespace .'/org/competition/index'
                );

                if(!is_null(FFSForm::Session())){
                    $lnkCrumb = $this->pnlBreadcrumb->AddCrumb(
                        FFSForm::Session()->Name,
                        '/' . FFSForm::Competition()->Namespace . '/org/competition/sessionDetails?' . FFSQS::IdSession . '=' . FFSForm::Session()->IdSession
                    );
                }
            }
        }


    }

    public function SetUpNavMenu(){
        $this->AddHeaderNav('Home', 'icon-home')->Href = '/';

        switch(FFSForm::$strSection){
            case(FFSSection::ORG):
                $lnkManageCompetitions = $this->AddHeaderNav('Competitions', 'icon-flag');
                $arrCompetitions = FFSApplication::GetActiveCompetitions();
                foreach($arrCompetitions as $objCompetition){
                    //_dv($lnkManageSessions);
                    $lnkManageCompetitions->AddSubNavLink(
                        $objCompetition->Name,
                        '/' . $objCompetition->Namespace . '/org/competition/index'
                    );
                }

                if(is_null(FFSForm::Competition())){

                    $lnkManageCompetitions->AddSubNavLink(
                        '<i class="icon-plus-sign"></i>Add New Competition',
                        '/org/competition/editCompetition'
                    );
                    $lnkManageCompetitions = $this->AddHeaderNav('Your Athletes', 'icon-user');
                    $lnkManageCompetitions->Href = '/org/manageAthletes';
                }else{
                    $lnkManageCompetitions->Href  = '/' . FFSForm::Competition()->Namespace . '/org/competition/index';

                    $lnkManageSessions = $this->AddHeaderNav('Manage Sessions', 'icon-calendar');
                    $lnkManageSessions->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/manageSessions';
                    $arrSessions = Session::LoadCollByIdCompetition(FFSForm::Competition()->IdCompetition)->getCollection();
                    foreach($arrSessions as $objSession){
                        //_dv($lnkManageSessions);
                        $lnkManageSessions->AddSubNavLink(
                            $objSession->Name,
                            '/' . FFSForm::Competition()->Namespace . '/org/competition/sessionDetails?' . FFSQS::IdSession . '='. $objSession->IdSession
                        );
                    }
                    $this->AddHeaderNav('Invite Gyms', 'icon-building')->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/manageGyms';
                    $this->AddHeaderNav('Manage Athletes', 'icon-user')->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/manageAthletes';

                    //Probablly don't allow untill meet starts
                    $this->AddHeaderNav('Results', 'icon-trophy')->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/results';

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
    public static function Org($objOrg = null){
        if(!is_null(self::$objForm)){
            if(is_null($objOrg)){
                return self::$objForm->objEntityManager->Org();
            }else{
                return self::$objForm->objEntityManager->Org($objOrg);
            }
        }
        if(is_null($objOrg)){
            return MLCApplication::$objRewriteHandeler->EntityManager->Org();
        }else{
            return MLCApplication::$objRewriteHandeler->EntityManager->Org($objOrg);
        }
    }
    public static function Session(){
        if(!is_null(self::$objForm)){
            return self::$objForm->objEntityManager->Session();
        }
        return MLCApplication::$objRewriteHandeler->EntityManager->Session();
    }
    public static function Competition($objCompetition = null){
        if(!is_null(self::$objForm)){
            return self::$objForm->objEntityManager->Competition($objCompetition);
        }
        return MLCApplication::$objRewriteHandeler->EntityManager->Competition($objCompetition);
    }
}