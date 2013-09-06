<?php
/**
 * Class and Function List:
 * Function list:
 * - Form_Create()
 * - Query()
 * - InitList()
 * - lnkEdit_click()
 * - lstEnrollment_editInit()
 * - lstEnrollment_editSave()
 * Classes list:
 * - EnrollmentManageForm extends EnrollmentManageFormBase
 */
class sessionDetails extends FFSForm {
    protected $lstEnrollments = null;
    protected $lstResults = null;
    protected $lstAssignments = null;
    public function Form_Create() {
        parent::Form_Create();

       // $this->InitEnrollmentList();
        $this->InitResults();
       // $this->InitAssignements();
        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->InitWizzard();
        }
    }
    public function InitWizzard(){

        $this->lstEnrollments->Intro("Add Athletes", "You may start manually adding athletes that are enrolled in your meet using the Athlete manager. Though it is much easier to invite coaches to enroll their athletes or use our Proscore import tool.");

        $this->lstEnrollments->Intro("Athlete List", "Once you have entered in an athlete they should appear in the Athlete List. You can assign that athlete to a division, or any other grouping you would like. Simply click on any field but the Athlete's name to edit it");

        $strBody = 'Oh no! You havent created any sessions for this competition yet. You will need to do that before we can move forward';
        $strUrl ='/' . FFSForm::Competition()->Namespace . '/org/competition/manageSessions';

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
    public function InitEnrollmentList(){
        //List enrolled athletes
        $this->lstEnrollments = new EnrollmentListPanel($this);
        $this->lstEnrollments->InitRowControl('edit_enrollment','Edit Enrollment', $this,'lnkEditEnrollment_click');
        $arrEnrollments = $this->objEntityManager->Session()->GetEnrollmentArr();

        $this->lstEnrollments->SetDataEntites($arrEnrollments);
        $this->lstEnrollments->EditMode = MJaxTableEditMode::NONE;
        $wgtWidget = $this->AddWidget(
            'Enrolled Atheletes',
            'icon-group',
            $this->lstEnrollments
        );
        $wgtWidget->AddCssClass('span12');

    }
    public function InitResults(){
        //results
        $this->lstResults = new ResultListPanel($this);
        $arrResults = FFSForm::Session()->GetResultArr();
        $this->lstResults->SetDataEntites($arrResults);
        $this->lstResults->AddEmptyRow();
        $wgtWidget = $this->AddWidget(
            'Results',
            'icon-trophy',
            $this->lstResults
        );
        $wgtWidget->AddCssClass('span12');
    }
    public function InitAssignements(){
        //devices

        $this->lstAssignments = new AssignmentListPanel($this);
        $arrAssignments = FFSForm::Session()->GetAssignmentArr();
        $this->lstAssignments->SetDataEntites($arrAssignments);
        $wgtWidget = $this->AddWidget(
            'Devices/Assignments',
            'icon-tablet',
            $this->lstAssignments
        );
        $wgtWidget->AddCssClass('span12');
    }
    public function lnkEditEnrollment_click($strFormId, $strControlId, $mixActionParameter){
        $this->Redirect(
            '/' . FFSForm::Competition()->Namespace . '/org/competition/manageAthletes',
            array(
                FFSQS::Session_IdSession => FFSForm::Session()->IdSession,
                FFSQS::Athelete_IdAthelete => $this->arrControls[$strControlId]->ParentControl->GetData('_entity')->IdAthelete
            )
        );
    }

}
sessionDetails::Run('sessionDetails');
