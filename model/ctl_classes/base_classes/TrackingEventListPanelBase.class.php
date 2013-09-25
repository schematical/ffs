<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - InitRemoveButtons()
* - lnkRemove_click()
* - RenderDate()
* - RenderTime()
* - SetupCols()
* - render_idSession()
* Classes list:
* - TrackingEventListPanelBase extends MJaxTable
*/
class TrackingEventListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrTrackingEvents = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrTrackingEvents);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objTrackingEvent = TrackingEvent::LoadById($strActionParameter);
        if (!is_null($objTrackingEvent)) {
            $objTrackingEvent->markDeleted();
        }
        foreach ($this->Rows as $intIndex => $objRow) {
            if ($objRow->ActionParameter == $strActionParameter) {
                $objRow->Remove();
                //unset($this->Rows[$intIndex]);
                $this->blnModified = true;
                return;
            }
        }
    }
    public function RenderDate($strData, $objRow) {
        return date_format(new DateTime($strData) , 'm/d/y');
    }
    public function RenderTime($strData, $objRow) {
        return date_format(new DateTime($strData) , 'h:i');
    }
    public function SetupCols() {
        //$this->AddColumn('idTrackingEvent','idTrackingEvent');
        $this->AddColumn('name', ' Name', null, null, 'MJaxTextBox');
        $this->AddColumn('value', ' Value', null, null, 'MJaxTextBox');
        $this->AddColumn('IdSessionObject', ' Session');
        $this->AddColumn('idApplication', ' Application', null, null, 'MJaxTextBox');
        $this->AddColumn('app', ' App', null, null, 'MJaxTextBox');
    }
    public function render_idSession($intIdIdSession, $objRow, $objColumn) {
        if (is_null($intIdIdSession)) {
            return '';
        }
        $objAuthSession = AuthSession::LoadById($intIdIdSession);
        if (is_null($objAuthSession)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objAuthSession->__toString();
        $lnkView->Href = '/data/editAuthSession?' . FFSQS::AuthSession_IdSession . '=' . $objAuthSession->IdSession;
        return $lnkView->Render(false);
    }
}
?>