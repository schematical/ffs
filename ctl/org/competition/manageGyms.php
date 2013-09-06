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
        $arrOrgs = FFSApplication::GetInvitedOrgsByCompetition();//$this->Query();

        $objOrg = null;
        if (count($arrOrgs) == 1) {
            $objOrg = $arrOrgs[0];
        }
        $this->InitList($arrOrgs);
        $this->InitEditPanel($objOrg);
        //$this->InitInvitePanel();

        $this->InitWizzard();



    }
    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter) {
        $objOrg = Org::LoadById($strActionParameter);
        $arrRolls = MLCAuthDriver::GetRollByEntity($objOrg, FFSRoll::ORG_MANAGER);
        if(
            (MLCAuthDriver::User()->HasRoll($objOrg, FFSRoll::ORG_MANAGER)) ||
            (
                (count($arrRolls) == 0) &&
                ($objOrg->IdImportAuthUser == MLCAuthDriver::IdUser())
            )
        ){
            parent::lnkEdit_click($strFormId, $strControlId, $strActionParameter);
        }else{
            $this->Alert("You may not edit a Gym that you did not create");
        }
        /*$this->pnlEdit->SetOrg();
        $this->lstOrgs->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
        $this->ScrollTo($this->pnlEdit);*/
    }
    public function InitSelectPanel() {
        $this->pnlSelect = new FFSOrgInvitePanel($this);
        $this->pnlSelect->AddAction(
            new MJaxSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlInvite_success'
            )
        );

        $wgtOrg = $this->AddWidget('Select Org', 'icon-select', $this->pnlSelect);
        $wgtOrg->AddCssClass('span12');
        return $wgtOrg;
    }
    public function pnlInvite_success($strFormId, $strControlId, $objOrg){
        $this->lstOrgs->AddRow($objOrg);
        $this->ScrollTo($this->lstOrgs);
    }
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
        $this->pnlInvite->AddAction(
            new MJaxSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlInvite_success'
            )
        );
        $this->wgtInvite->AddCssClass('span6');
    }

    public function InitWizzard(){
        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->pnlSelect->Intro("Invite a gym to enroll their Athletes in your competition", "You can search our system to find out if a gym has been added to our system previously. If it is in our system you can invite it to your competition here. Their athletes will be available to enroll", null,"bottom");

            $this->pnlEdit->Intro("Enter in gym's info manually", "If it is not in our system you can enter in its info here.");

            $this->lstOrgs->Intro("Gym List", "Here are the gyms you have invited and the gyms that have selected your competition as one the want to attend");

            $pnlWizzard = new FFSWizzardPanel(
                $this,
                'Ready to move on?',
                'Once you have added a couple of sessions you can go a head and add some athletes',
                '/' . FFSForm::Competition()->Namespace . '/org/competition/manageAthletes'
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
