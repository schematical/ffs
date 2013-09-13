<?php
class manageEnrollement extends FFSForm{
    protected $tblAtheletes = null;
    protected $pnlSessions = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/competition/manageEnrollment.tpl.php';
        $this->tblAtheletes = new AtheleteListPanel($this);
        $arrAtheletes = Athelete::Query('')->getCollection();

        $this->tblAtheletes->SetDataEntites($arrAtheletes);
        $arrSessions = FFSForm::Competition()->GetSessionArr();
        $this->pnlSessions = new FFSSessionEnrollmentPanel($this, null, $arrSessions);
    }
}
manageEnrollement::Run('manageEnrollement');