<?php
class manageEnrollement extends FFSForm{
    protected $pnlSearch = null;
    protected $tblEnrollment = null;
    protected $pnlSessions = null;
    protected $collEnrollments = null;
    protected $lnkAddAthelete = null;
    protected $lnkAddSession = null;

    protected $pnlEditAthelete = null;
    protected $pnlEditSession = null;

    protected $pnlPagination = null;


    protected $objSession = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/competition/manageEnrollment.tpl.php';
        $this->tblEnrollment = new EnrollmentListPanel($this);
        $this->collEnrollments = Enrollment::Query();
        $this->collEnrollments->AddFieldCondition(
            'Competition.idCompetition', FFSForm::Competition()->IdCompetition
        );
        $this->collEnrollments->Limit(10);


        $this->tblEnrollment->SetCollection($this->collEnrollments);
        $colEnroll = $this->tblEnrollment->AddColumn('btnEnroll','');
        $colEnroll->RenderObject = $this;
        $colEnroll->RenderFunction = 'colEnroll_render';

        $arrSessions = FFSForm::Competition()->GetSessionArr();
        $this->pnlSessions = new FFSSessionEnrollmentPanel($this, null, $arrSessions);
        $this->pnlSessions->AddAction(
            new FFSSessionEnrollPanelViewAllEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSession_viewAll'
            )
        );
        $this->pnlSessions->AddAction(
            new FFSSessionEnrollPanelSelectSessionEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSession_select'
            )
        );

        $this->lnkAddAthelete = new MJaxLinkButton($this);
        $this->lnkAddAthelete->AddCssClass('btn btn-large');
        $this->lnkAddAthelete->Text = "Add Athlete";
        $this->lnkAddAthelete->AddAction($this, 'lnkAddAthelete_click');


        $this->lnkAddSession = new MJaxLinkButton($this);
        $this->lnkAddSession->AddCssClass('btn btn-large');
        $this->lnkAddSession->Text = "Add Session";
        $this->lnkAddSession->AddAction($this, 'lnkAddSession_click');



        $this->pnlPagination = new MJaxPaginationPanel($this);
        $this->pnlPagination->SetCollection($this->collEnrollments);
        $this->pnlPagination->AddAction(
            new MJaxPaginationPanelPageChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlPagination_click'
            )
        );


        $this->pnlSearch = new MJaxAdvSearchPanel($this);
        $this->pnlSearch->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlSearch_change'
            )
        );

        $this->pnlSearch->SetCollection($this->collEnrollments);
        $this->pnlSearch->lstFields->AddItem(
            'Athelete First Name', 'Athelete.firstName'
        );
        $this->pnlSearch->lstFields->AddItem(
            'Athelete Last Name', 'Athelete.lastName'
        );
        $this->pnlSearch->lstFields->AddItem(
            'Gym', 'Athelete.lastName'
        );
        $this->pnlSearch->lstFields->AddItem(
            'Athelete Mem Id', 'Athelete.memId'
        );
        $this->pnlSearch->lstFields->AddItem(
            'Level', 'Enrollment_rel.level'
        );
        $this->pnlSearch->lstFields->AddItem(
            'Session', 'Session.name'
        );
        $this->UpdateSearch();

    }
    public function pnlPagination_click(){
        $this->UpdateSearch();
    }
    public function pnlSession_select($strFormId, $strControlId, $objSession){

        $this->objSession = $objSession;

        $this->UpdateSearch();
    }
    public function pnlSession_viewAll($strFormId, $strControlId, $objSession){
        if(!is_null($objSession)){
            $intIdSession = $objSession->IdSession;
        }else{
            $intIdSession = null;
        }
        $this->collEnrollments->RemoveFieldConditions('Enrollment_rel.idSession');
        $this->collEnrollments->RemoveFieldConditions('Session.name');
        $this->collEnrollments->AddFieldCondition(
            'Enrollment_rel.idSession',
            $intIdSession
        );
        $this->UpdateSearch();
    }
    public function pnlSearch_change(){
        $this->UpdateSearch();
    }
    public function UpdateSearch(){

        $this->tblEnrollment->UpdateFromCollection();

    }
    public function lnkAddAthelete_click()
    {
        if(is_null($this->pnlEditAthelete)){
            $this->pnlEditAthelete = new AtheleteEditPanel($this);
        }
        $this->pnlEditAthelete->SetAthelete(null);
        $this->pnlEditAthelete->AddAction(
            new MJaxDataEntitySaveEvent(),
            new MJaxServerControlAction(
                $this,
                'pnlEditAthelete_save'
            )
        );
        $this->Alert($this->pnlEditAthelete);

    }
    public function pnlEditAthelete_save($strFormId, $strControlId, Athelete $objAthelete){
        if($strControlId != $this->pnlEditAthelete->ControlId){
            return ;
        }
        if(!is_null($this->objSession)){
            $objEnrollment = $objAthelete->CreateEnrollmentFromSession(
                $this->objSession
            );
        }else{
            $objEnrollment = $objAthelete->CreateEnrollmentFromCompetition(
                FFSForm::Competition()
            );
        }
        $this->HideAlert();
        $objRow = $this->tblEnrollment->AddRow($objEnrollment);
        $this->ScrollTo($objRow);
    }
    public function colEnroll_render($strData, $objRow, $objCol){
        $objEnrollment = $objRow->GetData('_entity');
        if(is_null($this->objSession) || !is_null($objEnrollment->IdSession)){
            return '';
        }
        $btnEnroll = $objRow->GetData('btnEnroll');
        if(is_null($btnEnroll)){
            $btnEnroll = new MJaxLinkButton($this);
            $btnEnroll->Text = 'Enroll in ' . $this->objSession->Name;
            $btnEnroll->ActionParameter = $objEnrollment;
            $objRow->SetData('btnEnroll', $btnEnroll);
            $btnEnroll->AddAction(
                $this,
                'btnEnroll_click'
            );
        }
        return $btnEnroll->Render(false);
    }
    public function btnEnroll_click($f, $c, $objEnrollment){
        $this->Alert("<div class='alert alert-success'>Successfully Enrolled!</a>");
        $objEnrollment->IdSession = $this->objSession->IdSession;
        $objEnrollment->Save();

        $this->UpdateSearch();
    }

    public function lnkAddSession_click()
    {
        if(is_null($this->pnlEditSession)){
            $this->pnlEditSession = new SessionEditPanel($this);
            $this->pnlEditSession->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction(
                    $this,
                    'pnlEditSession_save'
                )
            );
        }
        $this->pnlEditSession->SetSession(null);

        $this->Alert($this->pnlEditSession);

    }
    public function pnlEditSession_save($strFormId, $strControlId, Session $objSession){
        $objSession->IdCompetition = FFSForm::Competition()->IdCompetition;
        $objSession->Save();
        if($strControlId != $this->pnlEditSession->ControlId){
            return ;
        }
        $this->HideAlert();
        $this->pnlSessions->Modified = true;
        $this->pnlSessions->AddSession($objSession);
        $this->pnlSessions->FocusSession($objSession);

    }
    public function InitWizzard(){
        if(!is_null(MLCApplication::QS(FFSQS::UseWizzard))){
            $pnlWizzard = new FFSWizzardPanel(
                $this,
                'Ready to move on?',
                'Once you have added a couple of sessions and added your athletes to your sessions please feel free to move on',
                '/' . FFSForm::Competition()->Namespace . '/org/competition/sessionDetails'
            );
            $wgtWizzard =$this->AddWidget(
                'Setup Wizzard',
                'icon-list-ol',
                $pnlWizzard
            );
            $wgtWizzard->AddCssClass('span6');




            $this->pnlSelect->Intro("Todo: Matt DO THIS", "", null,"bottom");

            /*$this->pnlEdit->Intro("Enter in gym's info manually", "If it is not in our system you can enter in its info here.");

            $this->lstOrgs->Intro("Gym List", "Here are the gyms you have invited and the gyms that have selected your competition as one the want to attend");

            $pnlWizzard->Intro("Ready to move on?", "When you are ready to move on to the next thing click here");*/



        }
    }

}
manageEnrollement::Run('manageEnrollement');