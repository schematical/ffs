<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AtheleteManageForm extends AtheleteManageFormBase
*/
class AtheleteManageForm extends AtheleteManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        if(is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->InitWizzard();
        }


        $this->InitSelectPanel();
        $arrAtheletes = $this->Query();
        $objAthelete = null;
        if (count($arrAtheletes) == 1) {
            $objAthelete = $arrAtheletes[0];
        }
        $this->InitEditPanel($objAthelete);



        $this->InitList($arrAtheletes);
    }
    public function InitWizzard(){

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
            $wgtWizzard->AddCssClass('span12');
            $pnlWizzard->Intro("Ready to move on?", "When you are ready to move on to the next thing click here");


    }
    public function Query() {
        //return parent::Query();
        $arrSessions = Enrollment::LoadCollByIdCompetition(FFSForm::$objCompetition->IdCompetition)->getCollection();
        return $arrSessions;
    }
}
AtheleteManageForm::Run('AtheleteManageForm');
