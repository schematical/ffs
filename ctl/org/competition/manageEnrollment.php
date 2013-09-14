<?php
class manageEnrollement extends FFSForm{
    protected $pnlSearch = null;
    protected $tblEnrollment = null;
    protected $pnlSessions = null;
    protected $collEnrollments = null;
    protected $lnkAddAthelete = null;
    protected $pnlEditAthelete = null;

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
        $arrAtheletes = $this->collEnrollments->getCollection();

        $this->tblEnrollment->SetDataEntites($arrAtheletes);
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
    }
    public function pnlSession_viewAll($strFormId, $strControlId, $objSession){
        if(!is_null($objSession)){
            $intIdSession = $objSession->IdSession;
        }else{
            $intIdSession = null;
        }
        $this->collEnrollments->RemoveFieldConditions('Enrollment_rel.idSession');
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
       $this->collEnrollments->ExecuteQuery();

       $arrAtheletes = $this->collEnrollments->GetCollection();
       $this->tblEnrollment->RemoveAllChildControls();
       $this->tblEnrollment->Alert("Result Count: " . count($arrAtheletes));
       $this->tblEnrollment->SetDataEntites($this->collEnrollments->GetCollection());
       /*$this->Alert(
           $this->collEnrollments->History[0]
       );*/
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
}
manageEnrollement::Run('manageEnrollement');