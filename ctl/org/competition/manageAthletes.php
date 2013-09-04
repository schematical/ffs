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



        $this->InitSelectPanel();
        $arrAtheletes = $this->Query();

        $objAthelete = null;
        if (count($arrAtheletes) == 1) {
            $objAthelete = $arrAtheletes[0];
        }
        $this->InitEditPanel($objAthelete);



        $this->InitList($arrAtheletes);
        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->InitWizzard();
        }
    }
    public function UpdateTable($objAthelete) {
        $objEnrollment = $objAthelete->GetEnrollmentArrByCompetition(FFSForm::$objCompetition);
        if(is_null($objEnrollment)){
            $objEnrollment = $objAthelete->CreateEnrollmentFromCompetition(FFSForm::$objCompetition);
            $objEnrollment->Save();
        }

        if (!is_null($this->lstEnrollments->SelectedRow)) {
            //This already exists

            $this->lstEnrollments->SelectedRow->UpdateEntity($objEnrollment);
            $this->lstEnrollments->SelectedRow = null;
        } else {
            $objRow = $this->lstEnrollments->AddRow($objEnrollment);
        }
    }
    public function InitList($arrAtheletes){
        $arrEnrollments = array();
        foreach($arrAtheletes as $objAthelete){
            $arrInvEnrollment = $objAthelete->GetEnrollmentArrByCompetition(FFSForm::$objCompetition);
            if(count($arrInvEnrollment) == 0){
                $objEnrollment = $objAthelete->CreateEnrollmentFromCompetition(FFSForm::$objCompetition);
                $objEnrollment->Save();
                $arrEnrollments[] = $objEnrollment;
            }else{
                foreach($arrInvEnrollment as $objEnrollment){
                    $arrEnrollments[] = $objEnrollment;
                };
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
        $this->AddWidget(
            'Atheletes',
            'icon-ul',
            $this->lstEnrollments
        );

    }
    public function pnlEdit_save($strFormId, $strControlId, $objAthelete) {
        if(is_null($objAthelete->IdOrg)){
            $intIdOrg = MLCApplication::QS(FFSQS::IdOrg);
            if(is_null($intIdOrg)){
                $intIdOrg = FFSForm::$objOrg->IdOrg;
            }
            if(!is_null($intIdOrg)){
                $objAthelete->IdOrg = $intIdOrg;
                $objAthelete->Save();
            }
        }
        parent::pnlEdit_save($strFormId, $strControlId, $objAthelete);
    }
    public function InitWizzard(){

            $this->pnlEdit->Intro("Add Athletes", "You may start manually adding athletes that are enrolled in your meet using the Athlete manager. Though it is much easier to invite coaches to enroll their athletes or use our Proscore import tool.");

            $this->lstEnrollments->Intro("Athlete List", "Once you have entered in an athlete they should appear in the Athlete List. You can assign that athlete to a division, or any other grouping you would like.");

            $pnlWizzard = new FFSWizzardPanel(
                $this,
                'Ready to move on?',
                'Once you have added some Athletes you can go a head assign Athletes to Sessions',
                '/' . FFSForm::$objCompetition->Namespace . '/org/competition/manageEnrollments'
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
        $intIdOrg = MLCApplication::QS(FFSQS::Athelete_IdOrg);
        if (!is_null($intIdOrg)) {
            $arrAndConditions[] = sprintf('idOrg = %s', $intIdOrg);
        }else{
            $arrIdOrgs = array();
            $arrOrgCompetition = FFSForm::$objCompetition->GetOrgCompetitionArr();
            foreach($arrOrgCompetition as $objOrgCompetition){
                $arrIdOrgs[] = $objOrgCompetition->IdOrg;
            }
            $arrAndConditions[] = sprintf('idOrg IN(%s)', implode(',', $arrIdOrgs));
        }


        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $arrAndConditions[] = sprintf('idAthelete = %s', $intIdAthelete);
        }

        $strFirstName = MLCApplication::QS(FFSQS::Athelete_FirstName);
        if (!is_null($strFirstName)) {
            $arrAndConditions[] = sprintf('firstName LIKE "%s%%"', $strFirstName);
        }
        $strLastName = MLCApplication::QS(FFSQS::Athelete_LastName);
        if (!is_null($strLastName)) {
            $arrAndConditions[] = sprintf('lastName LIKE "%s%%"', $strLastName);
        }
        $strMemType = MLCApplication::QS(FFSQS::Athelete_MemType);
        if (!is_null($strMemType)) {
            $arrAndConditions[] = sprintf('memType LIKE "%s%%"', $strMemType);
        }
        $strMemId = MLCApplication::QS(FFSQS::Athelete_MemId);
        if (!is_null($strMemId)) {
            $arrAndConditions[] = sprintf('memId LIKE "%s%%"', $strMemId);
        }
        $strLevel = MLCApplication::QS(FFSQS::Athelete_Level);
        if (!is_null($strLevel)) {
            $arrAndConditions[] = sprintf('level LIKE "%s%%"', $strLevel);
        }
        if (count($arrAndConditions) >= 1) {
            $arrAtheletes = Athelete::Query('WHERE ' . implode(' AND ', $arrAndConditions));
        } else {
            $arrAtheletes = array();
        }
        return $arrAtheletes;

    }
}
AtheleteManageForm::Run('AtheleteManageForm');
