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
* - render_idDevice()
* - render_idSession()
* Classes list:
* - AssignmentListPanelBase extends MJaxTable
*/
class AssignmentListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrAssignments = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrAssignments);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objAssignment = Assignment::LoadById($strActionParameter);
        if (!is_null($objAssignment)) {
            $objAssignment->markDeleted();
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
        //$this->AddColumn('idAssignment','idAssignment');
        $this->AddColumn('IdDeviceObject', ' Device');
        $this->AddColumn('IdSessionObject', ' Session');
        $this->AddColumn('event', ' Event', null, null, 'MJaxTextBox');
        $this->AddColumn('apartatus', ' Apartatus', null, null, 'MJaxTextBox');
        $this->AddColumn('revokeDate', ' Revoke Date', $this, 'RenderDate', 'MJaxBSDateTimePicker');
    }
    public function render_idDevice($intIdIdDevice, $objRow, $objColumn) {
        if (is_null($intIdIdDevice)) {
            return '';
        }
        $objDevice = Device::LoadById($intIdIdDevice);
        if (is_null($objDevice)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objDevice->__toString();
        $lnkView->Href = '/data/editDevice?' . FFSQS::Device_IdDevice . '=' . $objDevice->IdDevice;
        return $lnkView->Render(false);
    }
    public function render_idSession($intIdIdSession, $objRow, $objColumn) {
        if (is_null($intIdIdSession)) {
            return '';
        }
        $objSession = Session::LoadById($intIdIdSession);
        if (is_null($objSession)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objSession->__toString();
        $lnkView->Href = '/data/editSession?' . FFSQS::Session_IdSession . '=' . $objSession->IdSession;
        return $lnkView->Render(false);
    }
}
?>