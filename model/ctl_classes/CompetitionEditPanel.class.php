<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/CompetitionEditPanelBase.class.php");
class CompetitionEditPanel extends CompetitionEditPanelBase {
    public $txtOrgName = null;
    public $btnContinue = null;
    public function __construct($objParentControl, $objCompetion = null){
        parent::__construct($objParentControl, $objCompetion);

        $this->strNamespace->Attr('readonly', 'readonly');
        $this->strName->AddAction(
            new MJaxBlurEvent(),
            new MJaxServerControlAction($this, 'strName_blur')
        );
        $this->txtOrgName = new MJaxTextBox($this);

        $this->btnSave->Remove();
        $this->btnSave = null;
        $this->btnContinue = new MJaxLinkButton($this);
        $this->btnContinue->AddAction($this, 'btnContinue_click');
        $this->btnContinue->Text = 'Continue';
        $this->btnContinue->AddCssClass('btn btn-large btn-info');
    }
    public function strName_blur(){
        $this->strNamespace->Text = FFSRewriteHandeler::ConvertToNamespace(
            $this->strName->Text
        );
       //_dv($this->strName->Text);
    }
    public function btnContinue_click(){
        $this->objForm->ScrollTo($this->objForm->pnlSignup);
    }
    public function btnSave_click(){

        parent::btnSave_click();

        //Create new Org
        $objOrg = new Org();
        $objOrg->Name = $this->txtOrgName->Text;
        $objOrg->Namespace = FFSRewriteHandeler::ConvertToNamespace(
            $this->txtOrgName->Text
        );
        $objOrg->CreDate = MLCDateTime::Now();
        $this->objCompetition->IdOrg = $objOrg->IdOrg;
        $this->objCompetition->Save();
        return;
    }


}


?>