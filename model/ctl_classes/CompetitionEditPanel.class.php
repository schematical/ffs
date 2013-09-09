<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/CompetitionEditPanelBase.class.php");
class CompetitionEditPanel extends CompetitionEditPanelBase {

    public $txtOrgName = null;
    public $btnContinue = null;
    public $objOrg = null;


    public function __construct($objParentControl, $objCompetion = null){
        parent::__construct($objParentControl, $objCompetion);

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

    }
    public function SetCompetition($objCompetition, $objOrg = null){
        if(is_null($objOrg)){
            $objOrg = $objCompetition->IdOrgObject;
        }
        if(!is_null($objOrg)){
            //_dv($objOrg);
            $this->txtOrgName->Text = $objOrg->Name;
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
        $this->TriggerEvent('mjax-success');
        return;
    }
    public function GetCompetition(){
        return $this->objCompetition;
    }


}


?>