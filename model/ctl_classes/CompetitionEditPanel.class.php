<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/CompetitionEditPanelBase.class.php");
class CompetitionEditPanel extends CompetitionEditPanelBase {

    public $txtOrgName = null;
    public $btnContinue = null;
    public $objOrg = null;


    public function __construct($objParentControl, $objCompetion = null){
        parent::__construct($objParentControl, $objCompetion);
        //Because of the date init
        if (is_null($this->objCompetition)) {
            $this->SetCompetition($this->objCompetition);
        }
        $this->strNamespace->Attr('readonly', 'readonly');
        $this->strName->AddAction(
            new MJaxBlurEvent(),
            new MJaxServerControlAction($this, 'strName_blur')
        );
    }
    public function SetUpHomePage(){
        $this->btnSave->Remove();
        $this->btnSave = null;
        $this->btnDelete->Remove();
        $this->btnDelete = null;

        $this->btnContinue = new MJaxLinkButton($this);
        $this->btnContinue->AddAction($this, 'btnContinue_click');
        $this->btnContinue->Text = 'Continue';
        $this->btnContinue->AddCssClass('btn btn-large btn-info');
    }


    public function CreateFieldControls(){
        $this->txtOrgName = new MJaxTextBox($this);

        parent::CreateFieldControls();

        $this->dttStartDate->DateOnly();
        $this->dttStartDate->AddAction(
            new MJaxBSDatetimepickerChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'dttStartDate_change'
            )
        );
        $this->dttEndDate->DateOnly();


    }
    public function dttStartDate_change(){
        $strOffset = '+ 1 Days';

        $intTime = strtotime($strOffset . ' ' . $this->dttStartDate->GetValue());
        $strDate = date(MLCDateTime::MYSQL_FORMAT, $intTime);

        $this->dttEndDate->SetValue($strDate);
    }
    public function SetCompetition($objCompetition, $objOrg = null){
        if(is_null($objCompetition)){

            $this->dttStartDate->SetValue(MLCDateTime::Now());
            $this->dttEndDate->SetValue(MLCDateTime::Now('+ 1 Day'));
            $this->dttSignupCutOffDate->SetValue(MLCDateTime::Now());
        }else{
            if(is_null($objOrg)){
                $objOrg = $objCompetition->IdOrgObject;
            }
            if(!is_null($objOrg)){
                //_dv($objOrg);
                $this->txtOrgName->Text = $objOrg->Name;
            }
        }
        return parent::SetCompetition($objCompetition);
    }
    public function strName_blur(){
        $this->strNamespace->Text = FFSRewriteHandeler::ConvertToNamespace(
            $this->strName->Text
        );
       //_dv($this->strName->Text);
    }
    public function btnContinue_click(){
        $this->objForm->ScrollTo($this->objForm->pnlSignup);
        $this->objForm->pnlSignup->Alert('Almost there! Just fill out your login info.','success');
    }
    public function btnSave_click(){

        parent::btnSave_click();
        //Create new Org
        $this->objOrg = new Org();
        $this->objOrg->Name = $this->txtOrgName->Text;
        $this->objOrg->Namespace = FFSRewriteHandeler::ConvertToNamespace(

                $this->txtOrgName->Text


        );
        $this->objOrg->CreDate = MLCDateTime::Now();
        $this->objOrg->Save();

        $this->objCompetition->IdOrg = $this->objOrg->IdOrg;
        $this->objCompetition->Save();

        FFSApplication::InviteOrgToCompetition($this->objOrg, $this->objCompetition);
        $this->TriggerEvent('mjax-success');
        return;
    }
    public function GetCompetition(){
        return $this->objCompetition;
    }


}


?>