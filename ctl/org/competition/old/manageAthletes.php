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
    protected $lstEnrollments = null;
    public function Form_Create() {
        parent::Form_Create();


        $arrAtheletes = $this->Query();

        $this->InitList($arrAtheletes);

        $this->InitSelectPanel();

        $objAthelete = null;

        $this->InitEditPanel($objAthelete);




        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->InitWizzard();
        }
    }
    public function UpdateTable($objAthelete) {
        $objEnrollment = $objAthelete->GetEnrollmentArrByCompetition(FFSForm::Competition());
        if(count($objEnrollment) == 0){
            $objEnrollment = $objAthelete->CreateEnrollmentFromCompetition(FFSForm::Competition());
            $objEnrollment->Save();
        }

        if (!is_null($this->lstEnrollments->SelectedRow)) {
            //This already exists

            $this->lstEnrollments->SelectedRow->UpdateEntity($objEnrollment);
            $this->ScrollTo($this->lstEnrollments->SelectedRow);
            $this->lstEnrollments->SelectedRow = null;
        } else {
            $objRow = $this->lstEnrollments->AddRow($objEnrollment);
            $this->ScrollTo($objRow);
        }
    }
    public function InitList($arrAtheletes){
        $arrEnrollments = array();

        foreach($arrAtheletes as $mixAthelete){
            if($mixAthelete instanceof Athelete){
                $arrInvEnrollment = $mixAthelete->GetEnrollmentArrByCompetition(FFSForm::Competition());

                foreach($arrInvEnrollment as $objEnrollment){
                    $arrEnrollments[] = $objEnrollment;
                };

            }elseif($mixAthelete instanceof Enrollment){
                $arrEnrollments[] = $mixAthelete;
            }
        }

        $this->lstEnrollments = new EnrollmentListPanel($this, $arrEnrollments);

        $this->lstEnrollments->AddAction(
            new MJaxTableEditInitEvent(),
            new MJaxServerControlAction($this, 'lstAthelete_editInit')
        );
        $this->lstEnrollments->AddAction(
            new MJaxTableEditSaveEvent(),
            new MJaxServerControlAction($this, 'lstAthelete_editSave')
        );
        $wgtLstEnrollments = $this->AddWidget(
            'Atheletes',
            'icon-ul',
            $this->lstEnrollments
        );
        $wgtLstEnrollments->AddCssClass('span12');

    }
    public function pnlEdit_save($strFormId, $strControlId, $objAthelete) {
        if(is_null($objAthelete->IdOrg)){
            $intIdOrg = MLCApplication::QS(FFSQS::IdOrg);
            if(is_null($intIdOrg)){
                $intIdOrg = FFSForm::Org()->IdOrg;
            }
            if(!is_null($intIdOrg)){
                $objAthelete->IdOrg = $intIdOrg;
                $objAthelete->Save();
            }
        }
        //parent::pnlEdit_save($strFormId, $strControlId, $objAthelete); //Cant do because it has ref to lstAtheletes and were using lstEnrollments

        $this->UpdateTable($objAthelete);
        $this->pnlEdit->Alert('Saved!', 'info');

    }
    public function InitWizzard(){

            $this->pnlEdit->Intro("Add Athletes", "You may start manually adding athletes that are enrolled in your meet using the Athlete manager. Though it is much easier to invite coaches to enroll their athletes or use our Proscore import tool.");

            $this->lstEnrollments->Intro("Athlete List", "Once you have entered in an athlete they should appear in the Athlete List. You can assign that athlete to a division, or any other grouping you would like. Simply click on any field but the Athlete's name to edit it");
            $arrSessions = FFSForm::Competition()->GetSessionArr();
            if(count($arrSessions) > 0){
                $strBody = 'When you have entered your Athletes click below to move on to managing a specific session';
                $strUrl ='/' . FFSForm::Competition()->Namespace . '/org/competition/sessionDetails?' . FFSQS::Session_IdSession . '=' . $arrSessions[0]->IdSession;
            }else{
                $strBody = 'Oh no! You havent created any sessions for this competition yet. You will need to do that before we can move forward';
                $strUrl ='/' . FFSForm::Competition()->Namespace . '/org/competition/manageSessions';
            }
            $pnlWizzard = new FFSWizzardPanel(
                $this,
                'Ready to move on?',
                $strBody,
                $strUrl
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

        $arrAndConditions = array();
        if(!is_null($this->objEntityManager->Session())){
            $arrAndConditions[]  = sprintf('Enrollment_rel.idSession = %s', $this->objEntityManager->Session()->IdSession);
        }elseif(!is_null(FFSForm::Competition())){
            $arrAndConditions[]  = sprintf('Enrollment_rel.idCompetition = %s', $this->objEntityManager->Competition()->IdCompetition);
        }

        $intIdOrg = MLCApplication::QS(FFSQS::Athelete_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('Athelete.idOrg = %s', $intIdOrg);
        }

        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('Athelete.idAthelete = %s', $intIdAthelete);
        }

        $strFirstName = MLCApplication::QS(FFSQS::Athelete_FirstName);
        if (!is_null($strFirstName)) {
            $arrAndConditions[] = sprintf('Athelete.firstName LIKE "%s%%"', $strFirstName);
        }
        $strLastName = MLCApplication::QS(FFSQS::Athelete_LastName);
        if (!is_null($strLastName)) {
            $arrAndConditions[] = sprintf('Athelete.lastName LIKE "%s%%"', $strLastName);
        }
        $strMemType = MLCApplication::QS(FFSQS::Athelete_MemType);
        if (!is_null($strMemType)) {
            $arrAndConditions[] = sprintf('Athelete.memType LIKE "%s%%"', $strMemType);
        }
        $strMemId = MLCApplication::QS(FFSQS::Athelete_MemId);
        if (!is_null($strMemId)) {
            $arrAndConditions[] = sprintf('Athelete.memId LIKE "%s%%"', $strMemId);
        }
        $strLevel = MLCApplication::QS(FFSQS::Athelete_Level);
        if (!is_null($strLevel)) {
            $arrAndConditions[] = sprintf('Athelete.level LIKE "%s%%"', $strLevel);
        }
        if (count($arrAndConditions) >= 1) {
            $arrAtheletes = Enrollment::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrAtheletes = array();
        }
        return $arrAtheletes;

    }
}
AtheleteManageForm::Run('AtheleteManageForm');
