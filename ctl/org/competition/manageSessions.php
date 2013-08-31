<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - SessionManageForm extends SessionManageFormBase
*/
class SessionManageForm extends SessionManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        //$this->InitSelectPanel();
        $arrSessions = $this->Query();




        $this->InitList($arrSessions);
        $this->InitEditPanel();
        $this->InitWizzard();

        $this->pnlBreadcrumb->AddCrumb(
            'Manage Sessions'
        );

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
                '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageGyms'
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
    public function Query() {
        //return parent::Query();
        $arrSessions = Session::LoadCollByIdCompetition(FFSForm::$objCompetition->IdCompetition)->getCollection();
        return $arrSessions;
    }
    public function pnlEdit_save($strFormId, $strControlId, $objSession) {
        $objSession->IdCompetition = FFSForm::$objCompetition->IdCompetition;
        $objSession->Save();
        parent::pnlEdit_save($strFormId, $strControlId, $objSession);
    }
}
SessionManageForm::Run('SessionManageForm');
