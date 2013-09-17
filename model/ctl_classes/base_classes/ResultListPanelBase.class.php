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
* - render_idAthelete()
* Classes list:
* - ResultListPanelBase extends MJaxTable
*/
class ResultListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrResults = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrResults);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objResult = Result::LoadById($strActionParameter);
        if (!is_null($objResult)) {
            $objResult->markDeleted();
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
        //$this->AddColumn('idResult','idResult');
        $this->AddColumn('IdSessionObject', ' Session');
        $this->AddColumn('IdAtheleteObject', ' Athelete');
        $this->AddColumn('score', ' Score', null, null, 'MJaxTextBox');
        $this->AddColumn('judge', ' Judge', null, null, 'MJaxTextBox');
        $this->AddColumn('flag', ' Flag', null, null, 'MJaxTextBox');
        $this->AddColumn('event', ' Event', null, null, 'MJaxTextBox');
        $this->AddColumn('sanctioned', ' Sanctioned', null, null, 'MJaxTextBox');
        $this->AddColumn('notes', ' Notes', null, null, 'MJaxTextArea');
        $this->AddColumn('startValue', ' Start Value', null, null, 'MJaxTextBox');
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
    public function render_idAthelete($intIdIdAthelete, $objRow, $objColumn) {
        if (is_null($intIdIdAthelete)) {
            return '';
        }
        $objAthelete = Athelete::LoadById($intIdIdAthelete);
        if (is_null($objAthelete)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objAthelete->__toString();
        $lnkView->Href = '/data/editAthelete?' . FFSQS::Athelete_IdAthelete . '=' . $objAthelete->IdAthelete;
        return $lnkView->Render(false);
    }
}
?>