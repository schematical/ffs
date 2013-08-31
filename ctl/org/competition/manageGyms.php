<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - OrgManageForm extends OrgManageFormBase
*/
class OrgManageForm extends OrgManageFormBase {
    protected $blnInlineEdit = false;


    public $pnlInvite = null;
    public $wgtInvite = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrOrgs = $this->Query();
        $objOrg = null;
        if (count($arrOrgs) == 1) {
            $objOrg = $arrOrgs[0];
        }

        $this->InitEditPanel($objOrg);
        //$this->InitInvitePanel();
        $this->InitList($arrOrgs);



    }
    /*public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        parent::lnkEdit_click($strFormId, $strControlId, $strActionParameter);
        $objOrg = Org::LoadById($strActionParameter);
        $arrEntityManagers = MLCAuthDriver::GetRollByEntity($objOrg, FFSRoll::ORG_MANAGER);
        if(
            (count($arrEntityManagers) == 0) ||
            (MLCAuthDriver::User()->HasRoll($objOrg, FFSRoll::ORG_MANAGER))
        ){
            $this->pnlInvite->SetEntity(
                $objOrg,
                FFSRoll::ORG_MANAGER
            );
            $this->wgtInvite->Style->Display = 'inline';
        }else{
            //Hide it
             $this->wgtInvite->Style->Display = 'none';
        }

    }*/
    public function pnlEdit_save($strFormId, $strControlId, $objOrg){
        parent::pnlEdit_save($strFormId, $strControlId, $objOrg);

        $arrEntityManagers = MLCAuthDriver::GetRollByEntity($objOrg, FFSRoll::ORG_MANAGER);
        //_dv($arrEntityManagers);
        if(
            (count($arrEntityManagers) == 0) ||
            (MLCAuthDriver::User()->HasRoll($objOrg, FFSRoll::ORG_MANAGER))
        ){
            if(is_null($this->pnlInvite)){
                $this->pnlInvite = new MLCInvitePanel($this);
            }
            $this->pnlInvite->SetEntity($objOrg, FFSRoll::ORG_MANAGER);
            $this->Alert($this->pnlInvite);
        }
    }
    public function InitInvitePanel(){
        $this->pnlInvite = new MLCInvitePanel($this);
        $this->wgtInvite = $this->AddWidget(
            'Invite',
            'envelope-alt',
            $this->pnlInvite
        );
        $this->wgtInvite->AddCssClass('span6');
    }

    public function InitWizzard(){
        if(is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->pnlEdit->Intro("Enter in your session info", "Start by entering in a sessions info such as a unique name, a start time and an end time. If you are running more than one sessions at a time use the <b>Equipment Set</b> field to denote which set of equipment this session is running on.");

            $this->lstSessions->Intro("Here are your sessions", "Once you have entered in a session it should appear in the session list. Each row has the following buttons:
                <ul>
                    <li>Edit - Allows you to edit a sessions data</li>
                    <li>Athletes - Allows you to control the enrollment of athletes into a session</li>
                </ul>
            ");

            $pnlWizzard = new FFSWizzardPanel(
                $this,
                'Ready to move on?',
                'Once you have added a couple of sessions you can go a head and add some athletes',
                '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageAthletes'
            );
            $wgtWizzard =$this->AddWidget(
                'Setup Wizzard',
                'icon-list-ol',
                $pnlWizzard
            );
            $wgtWizzard->AddCssClass('span6');
            $pnlWizzard->Intro("Ready to move on?", "When you are ready to move on to the next thing click here");


        }
    }
}
OrgManageForm::Run('OrgManageForm');
