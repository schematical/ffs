<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AuthUserListPanelBase.class.php");
class FFSStaffListPanel extends AuthUserListPanelBase {

    public function __construct($objParentControl, $arrAuthUsers = array()){

        parent::__construct($objParentControl, $arrAuthUsers = array());
        $this->AddCssClass('table table-striped table-bordered');

    }

    public function SetupCols(){
        $this->AddColumn('email','email');
        $this->AddColumn('username','username');

        //TODO: Surround this with an if statement
        $this->SetUpLeadAdminCols();

    }
    public function SetUpLeadAdminCols(){
        $this->InitRowControl(
            'del',
            'Remove',
            $this,
            'rowDelete_click'
        );
    }
    public function rowDelete_click($f, $c, $ap){
        $this->rowSelected =  $this->objForm->Controls[$c]->ParentControl;
        $objUser = $this->rowSelected->GetData('_entity');
        $pnlConfirm = new MJaxBSConfirmPanel($this);
        $pnlConfirm->ActionParameter = $objUser;
        $pnlConfirm->Text = sprintf('Are you sure you want to remove %s from your gym', $objUser->Email);
        $pnlConfirm->AddAction(
            new MJaxBSConfirmEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlConfirm_confirm'
            )
        );
        $this->objForm->Alert($pnlConfirm);
    }

    public function pnlConfirm_confirm($f, $c, AuthUser $ap)
    {
        $objRoll = $ap->GetUserRollByEntity(
            FFSForm::Org(),
            FFSRoll::ORG_MANAGER
        );
        $objRoll->MarkAllDeleted();
        $this->rowSelected->Remove();
        $this->blnModified = true;


    }
}


?>