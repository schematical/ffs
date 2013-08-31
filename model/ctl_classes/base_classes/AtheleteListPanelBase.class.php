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
* - lnkViewEnrollments_click()
* - lnkViewParentMessages_click()
* - lnkViewResults_click()
* - render_idOrg()
* Classes list:
* - AtheleteListPanelBase extends MJaxTable
*/
class AtheleteListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrAtheletes = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrAtheletes);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objAthelete = Athelete::LoadById($strActionParameter);
        if (!is_null($objAthelete)) {
            $objAthelete->markDeleted();
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
        //$this->AddColumn('idAthelete','idAthelete');
        $this->AddColumn('idOrg', ' Org', $this, 'render_idOrg', 'MJaxTextBox');
        $this->AddColumn('firstName', ' First Name', null, null, 'MJaxTextBox');
        $this->AddColumn('lastName', ' Last Name', null, null, 'MJaxTextBox');
        $this->AddColumn('memType', ' Mem Type', null, null, 'MJaxTextBox');
        $this->AddColumn('memId', ' Mem Id', null, null, 'MJaxTextBox');
        $this->AddColumn('level', ' Level', null, null, 'MJaxTextBox');
        $this->InitRowControl('view_Enrollments', 'View Enrollments', $this, 'lnkViewEnrollments_click', 'btn btn-small');
        $this->InitRowControl('view_ParentMessages', 'View ParentMessages', $this, 'lnkViewParentMessages_click', 'btn btn-small');
        $this->InitRowControl('view_Results', 'View Results', $this, 'lnkViewResults_click', 'btn btn-small');
    }
    public function lnkViewEnrollments_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editEnrollment', array(
            FFSQS::Athelete_IdAthelete => $strActionParameter
        ));
    }
    public function lnkViewParentMessages_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editParentMessage', array(
            FFSQS::Athelete_IdAthelete => $strActionParameter
        ));
    }
    public function lnkViewResults_click($strFormId, $strControlId, $strActionParameter) {
        $this->objForm->Redirect('/data/editResult', array(
            FFSQS::Athelete_IdAthelete => $strActionParameter
        ));
    }
    public function render_idOrg($intIdIdOrg, $objRow, $objColumn) {
        if (is_null($intIdIdOrg)) {
            return '';
        }
        $objOrg = Org::LoadById($intIdIdOrg);
        if (is_null($objOrg)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objOrg->__toString();
        $lnkView->Href = '/data/editOrg?' . FFSQS::Org_IdOrg . '=' . $objOrg->IdOrg;
        return $lnkView->Render(false);
    }
}
?>