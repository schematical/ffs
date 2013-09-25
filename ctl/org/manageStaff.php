<?php
class manageStaff extends FFSForm{
    public $tblStaff =  null;
    public $pnlStaffInvite = null;


    public function Form_Create(){
        parent::Form_Create();
        $this->SecureOrg();
        $this->InitStaffInvitePanel();
        $this->InitStaffTable();
    }
    public function InitStaffInvitePanel(){
        $this->pnlStaffInvite = new MLCInvitePanel(
            $this,
            FFSForm::Org(),
            FFSRoll::ORG_MANAGER
        );
        $this->pnlStaffInvite->AddAction(
            new MJaxSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlStaffInvite_success'
            )
        );
        $wgtInvite = $this->AddWidget(
            'Invite Staff',
            'icon-envelop',
            $this->pnlStaffInvite
        );
        $wgtInvite->AddCssClass('span6');
    }
    public function InitStaffTable(){
        $arrUsers = MLCAuthDriver::GetUsersByEntity(
            FFSForm::Org(),
            FFSRoll::ORG_MANAGER
        );
        $this->tblStaff = new FFSStaffListPanel($this);
        $this->tblStaff->SetDataEntites($arrUsers);
        $wgtStaff = $this->AddWidget(
            'Staff',
            'icon-group',
            $this->tblStaff
        );
        $wgtStaff->AddCssClass('span6');

    }
    public function pnlStaffInvite_success($f, $c, $ap){
        if(strlen($ap->inviteEmail) > 1){
            FFSApplication::SendEmail(
                FFSEmailType::StaffInvite,
                $ap->inviteEmail,
                'You have been invited to manage ' . FFSForm::Org()->Name,
                array(
                    'AUTH_ROLL' => $ap
                )
            );
        }
    }
}
manageStaff::Run('manageStaff');