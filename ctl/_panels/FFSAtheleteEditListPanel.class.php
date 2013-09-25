<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/AtheleteListPanelBase.class.php");
class FFSAtheleteEditListPanel extends AtheleteListPanelBase {
    protected $pnlInvite = null;
    public function __construct($objParentControl, $arrAtheletes = array()){

        parent::__construct($objParentControl, $arrAtheletes);
        $this->strEditMode = MJaxTableEditMode::INLINE;
        $this->AddCssClass('table table-striped table-bordered table-condensed');

    }
    public function SetupCols() {
        //$this->AddColumn('idAthelete','idAthelete');
        //$this->AddColumn('IdOrgObject', ' Org');
        $colFirstName = $this->AddColumn('firstName', ' First Name');
        $colFirstName->Editable = true;
        $colFirstName->EditControlClass = 'MJaxTextBox';

        $colLastName = $this->AddColumn('lastName', ' Last Name');
        $colLastName->Editable = true;
        $colLastName->EditControlClass = 'MJaxTextBox';

        $colBirthDate = $this->AddColumn('birthDate', ' Birth');
        $colBirthDate->Editable = true;

        $colBirthDate->RenderObject = $this;
        $colBirthDate->RenderFunction = 'RenderEditDate';

        $colMemType = $this->AddColumn('memType', ' Mem Type');


        $colMemId = $this->AddColumn('memId', ' Mem Id');
        $colMemId->Editable = true;
        $colMemId->EditControlClass = 'MJaxTextBox';

        $colLevel = $this->AddColumn('level', ' Level');
        $colLevel->Editable = true;
        $colLevel->EditControlClass = 'MJaxTextBox';

        $this->InitRowControl('view_Results', 'View Results', $this, 'lnkViewResults_click', 'btn btn-small');
        //$this->InitRowControl('invite_parent', 'Invite Parent', $this, 'lnkInviteParent_click', 'btn btn-small');
    }
    public function AddEmptyRow(){
        $objRow = parent::AddEmptyRow();
        $objRow->SetData('memType', FFSForm::Org()->ClubType);
        return $objRow;
    }
    public function RenderEditDate($strData, $objRow, $objCol){
        if($objRow->IsSelected() && $objCol->IsSelected()){
            $objRow->arrEditControls[$objCol->Key] = new MJaxBSDateTimePicker($this->objForm);
            $objRow->arrEditControls[$objCol->Key]->DateOnly();
            $objRow->arrEditControls[$objCol->Key]->RemoveMinStartDate();
            $objRow->arrEditControls[$objCol->Key]->SetValue($strData);
            return $objRow->arrEditControls[$objCol->Key]->Render(false);

        }else{
            return $this->RenderDate($strData, $objRow, $objCol);
        }
    }
    public function lnkViewResults_click($f, $c, $intIdAthelete){
        $this->objForm->CPRedirect(
            '/results',
            array(
                FFSQS::Athelete_IdAthelete => $intIdAthelete
            )
        );
    }
    public function lnkInviteParent_click($f, $c, $ap){
        $objEntity = $this->objForm->Controls[$c]->ParentControl->GetData('_entity');
        $this->pnlInvite = new MLCInvitePanel($this->objForm, $objEntity, FFSRoll::PARENT);
        $this->pnlInvite->AddAction(
            new MJaxSuccessEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlInvite_success'
            )
        );
        $this->objForm->Alert($this->pnlInvite);
    }
    public function pnlInvite_success($f, $c, $ap){
        if(strlen($ap->inviteEmail) > 1){
            FFSApplication::SendEmail(
                FFSEmailType::ParentInvite,
                $ap->inviteEmail,
                FFSForm::Org()->Name . ' would like to welcome you to the team',
                array(
                    'AUTH_ROLL' => $ap
                )
            );
        }
    }



}


?>