<?php
class FFSForm extends MJaxWAdminForm{
    protected $strTitle = 'Tumble Score, Gymnastics Competition Management Software Done Right';
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
        if(!is_null($this->Competition())){
            //$this->InitAds();
        }
        $this->SetUpBreadcrumbs();
    }
    public function ForceLandscape(){
        $this->AddJSCall(
            '$(function(){
                FFS.InitCtlMemory();
                FFS.InitScreenRotation();
            });'
        );
    }
    public function SecureCompetition(){

        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        if(is_null(FFSForm::Competition())){
            $this->Redirect('/org');
        }

        if(!MLCAuthDriver::User()->HasRoll(FFSForm::Competition()->IdOrgObject, FFSRoll::ORG_MANAGER)){
            $this->Redirect('/org');
        }
    }
    public function SecureOrg(){
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        if(is_null(FFSForm::Org())){
            $this->Redirect('/index');
        }

        if(!MLCAuthDriver::User()->HasRoll(FFSForm::Org(), FFSRoll::ORG_MANAGER)){
            $this->Redirect('/index');
        }
    }
    public function SecureParent(){
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        $arrAtheletes = FFSApplication::GetAtheletesByParent();

        if(count($arrAtheletes) == 0){
            $this->Redirect('/index');
        }
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
        $objOrg = FFSForm::Org();
        if(is_null($objOrg)){
            $arrOrgs = MLCAuthDriver::GetRolls(FFSRoll::ORG_MANAGER);

            if(count($arrOrgs) == 0){
                //Do nothing
            }elseif(count($arrOrgs) == 1){
                $this->Org($arrOrgs[0]->GetEntity());

            }else{
                $this->Org($arrOrgs[0]->GetEntity());
            }
        }

        switch(FFSForm::$strSection){
            case(FFSSection::ORG):

                //_dv(FFSApplication::GetCompetitionsByOrgAtheleteResults($this->Org())->getCollection());

                $this->AddHeaderNav('Home', 'icon-home')->Href = '/';
                $lnkManageCompetitions = $this->AddHeaderNav('Competitions', 'icon-flag');
                $arrCompetitions = FFSApplication::GetActiveCompetitions();
                if(!is_null(MLCAuthDriver::User())){
                    $arrCompetitions = array_merge(
                        $arrCompetitions->GetCollection(),
                        FFSApplication::GetCompetitionsByOrgAtheleteResults($this->Org())->getCollection()
                    );
                }

                foreach($arrCompetitions as $objCompetition){
                    //_dv($lnkManageSessions);
                    if($objCompetition->IdOrg == FFSForm::Org()->IdOrg){
                        $strIcon = '<i class=" icon-trophy"></i>';
                        $lnkManageCompetitions->AddSubNavLink(
                            $strIcon . $objCompetition->Name,
                            '/' . $objCompetition->Namespace . '/org/competition/index'
                        );

                    }else{
                        if($objCompetition->Sanctioned){
                            $strIcon = '<i class=" icon-calendar"></i>';
                            $lnkManageCompetitions->AddSubNavLink(
                                $strIcon . $objCompetition->Name,
                                '/' . $objCompetition->Namespace . '/org/competition/index'
                            );
                        }else{
                            $strIcon = '<i class=" icon-calendar-empty"></i>';
                            $lnkManageCompetitions->AddSubNavLink(
                                $strIcon . $objCompetition->Name,
                                $this->CPRedirect(
                                '/results',
                                    array(
                                        FFSQS::Competition_IdCompetition => $objCompetition->IdCompetition
                                    ),
                                    true
                                )
                            );
                        }
                    }

                }

                if(
                    (!is_null(FFSForm::Competition())) &&
                    (!is_null(MLCAuthDriver::User())) &&
                    (MLCAuthDriver::User()->HasRoll(FFSForm::Competition()->IdOrgObject, FFSRoll::ORG_MANAGER))
                ){


                    $lnkManageCompetitions->Href  = '/' . FFSForm::Competition()->Namespace . '/org/competition/index';

                    $lnkManageSessions = $this->AddHeaderNav('Manage Sessions', 'icon-calendar');
                    $lnkManageSessions->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/manageEnrollment';
                    $arrSessions = Session::LoadCollByIdCompetition(FFSForm::Competition()->IdCompetition)->getCollection();
                    foreach($arrSessions as $objSession){
                        //_dv($lnkManageSessions);
                        $lnkManageSessions->AddSubNavLink(
                            $objSession->Name,
                            '/' . FFSForm::Competition()->Namespace . '/org/competition/sessionDetails?' . FFSQS::IdSession . '='. $objSession->IdSession
                        );
                    }
                    $this->AddHeaderNav('Invite Gyms', 'icon-building')->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/manageGyms';

                    $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();
                    $lnkAthelete = $this->AddHeaderNav('Manage Athletes', 'icon-user');
                    $lnkAthelete->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/manageEnrollment';

                    //Probablly don't allow untill meet starts
                    $this->AddHeaderNav('Results', 'icon-trophy')->Href = '/' . FFSForm::Competition()->Namespace . '/org/competition/results';

                }else{
                    $lnkManageCompetitions->AddSubNavLink(
                        '<i class="icon-plus-sign"></i>Host a Competition',
                        '/org/competition/editCompetition'
                    );
                    $lnkManageAtheletes= $this->AddHeaderNav('Your Athletes', 'icon-group');
                    $lnkManageAtheletes->Href = '/org/manageAthletes';
                    /*foreach($arrAtheletes as $objAthelete){
                        $lnkAthelete->AddSubNavLink($objAthelete->__toString(),'/parent/results?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete);
                    }*/
                    $lnkTeamStats = $this->AddHeaderNav('Team Stats', 'icon-list')->Href = '/parent/results';

                }

            break;
            case(FFSSection::PARENT):
                //TODO - Add invite/share functionality
                if(!is_null(MLCAuthDriver::User())){
                    $this->AddHeaderNav('Home', 'icon-home')->Href = '/parent';
                    $this->AddHeaderNav('My Competitions', 'icon-flag')->Href = '/parent/home';
                    $arrAtheletes = FFSApplication::GetAtheletesByParent();
                    if(count($arrAtheletes < 3)){
                        foreach($arrAtheletes as $objAthelete){
                            $lnkAthelete = $this->AddHeaderNav($objAthelete->FirstName, 'icon-smile');
                            $lnkAthelete->AddSubNavLink('Stats','/parent/results?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete);
                            $lnkAthelete->AddSubNavLink('Timeline','/parent/feed?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete);
                        }
                    }else{
                        $lnkMyTeam = $this->AddHeaderNav('My Team', 'icon-flag');
                        foreach($arrAtheletes as $objAthelete){
                            $lnkMyTeam->AddSubNavLink($objAthelete->__toString(), 'icon-smile')->Href = '/parent/athleteDetails?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete;
                        }
                    }
                    $this->AddHeaderNav('Pro-store', 'icon-star')->Href = '/parent/prostore';

                }

            break;
            default:
                $this->AddHeaderNav('FAQ', 'icon-question-sign')->Href = '/faq';
                $this->AddHeaderNav('Competition Hosts', 'icon-trophy')->Href = '/org/competition/landing';
                $this->AddHeaderNav('Parents', 'icon-female')->Href = '/parent/landing';
                $this->AddHeaderNav('Team Coaches', 'icon-group')->Href = '/org/landing';

                $this->AddHeaderNav('Contact Us', 'icon-phone')->Href = '/contactUs';


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
    public static function IsParent($objUser = null){
        $arrAtheletes = FFSApplication::GetAtheletesByParent($objUser);
        if(count($arrAtheletes) > 0){
            return true;
        }else{
            return false;
        }
    }
    public static function IsOrgManager($objUser = null){
        $arrOrgs = FFSApplication::GetOrgsByOrgManager($objUser);
        if(count($arrOrgs) > 0){
            return true;
        }else{
            return false;
        }
    }
    public function CPRedirect($strUrl, $arrQS = array(), $blnReturnUrl = false){
        if($this->IsOrgManager()){
            $strUri = '/org' . $strUrl;
        }else{
            $strUri = '/parent' . $strUrl;
        }
        if($blnReturnUrl){
            return $strUri .'?'. http_build_query($arrQS);
        }
        return $this->Redirect($strUri, $arrQS);
    }
}