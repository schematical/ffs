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
    protected $pnlMain = null;
    protected $lstEnrollments = null;
    protected $lstResults = null;
    protected $lstAssignments = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->SecureCompetition();
        $objSession = $this->objEntityManager->Session();
        if(is_null($objSession)){
            $this->Redirect('/' . FFSForm::Competition()->Namespace .'/org/competition/index');
        }
        $this->InitMain();
        $this->InitEnrollmentList();
        $this->InitResults();
        //$this->InitAssignements();
        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $this->InitWizzard();
        }

    }
    public function InitMain(){
        $objSession = $this->objEntityManager->Session();

        $this->pnlMain = new FFSSessionControlPanel($this, $objSession);
        $wgtMain = $this->AddWidget(
            $objSession->Name,
            'icon-flag',
            $this->pnlMain
        );
        $wgtMain->AddCssClass('span12');
    }
    public function InitWizzard(){

        $this->pnlMain->Intro("Here is where you run your sessions", "This is the main page for managing an active session during your competition. You can use the short cuts to navigate this page.");


        $this->lstEnrollments->Intro("View Enrolled Athletes", "Here you can view list of athletes you enrolled in this session. You can add more athletes to this session on the <a href='/" . FFSForm::Competition()->Namespace . "/org/competition/manageAthletes'>Manage Athlete Screen</a>");

        $this->lstResults->Intro("Results List", "Here you can enter in results as they come in. Just click the blank row at the bottom and start typing an Athlete's name or number. It should auto populate with the athlete's information then you can enter in the score. If you need to edit a score just click on the record.");

        $strBody = 'Oh no! You havent created any sessions for this competition yet. You will need to do that before we can move forward';
        $strUrl ='/' . FFSForm::Competition()->Namespace . '/org/competition/results';

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
        $pnlWizzard->Intro("Ready to move on to the result screen?", "When you are ready to move on to the next thing click here");


    }
    public function InitEnrollmentList(){
        //List enrolled athletes
        $this->lstEnrollments = new EnrollmentListPanel($this);
        $this->lstEnrollments->AddCssClass('ffs-enrollment-list');
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
        $this->lstResults->AddCssClass('ffs-result-list');
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
        $this->lstAssignments->AddCssClass('ffs-assignment-list');
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
