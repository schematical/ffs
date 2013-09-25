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
* - render_idAccount()
* Classes list:
* - MLCLocationListPanelBase extends MJaxTable
*/
class MLCLocationListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrMLCLocations = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrMLCLocations);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objMLCLocation = MLCLocation::LoadById($strActionParameter);
        if (!is_null($objMLCLocation)) {
            $objMLCLocation->markDeleted();
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
        //$this->AddColumn('idLocation','idLocation');
        $this->AddColumn('shortDesc', ' Short Desc', null, null, 'MJaxTextBox');
        $this->AddColumn('address1', ' Address 1', null, null, 'MJaxTextBox');
        $this->AddColumn('address2', ' Address 2', null, null, 'MJaxTextBox');
        $this->AddColumn('city', ' City', null, null, 'MJaxTextBox');
        $this->AddColumn('state', ' State', null, null, 'MJaxTextBox');
        $this->AddColumn('zip', ' Zip', null, null, 'MJaxTextBox');
        $this->AddColumn('country', ' Country', null, null, 'MJaxTextBox');
        $this->AddColumn('lat', ' Lat', null, null, 'MJaxTextBox');
        $this->AddColumn('lng', ' Lng', null, null, 'MJaxTextBox');
        $this->AddColumn('IdAccountObject', ' Account');
    }
    public function render_idAccount($intIdIdAccount, $objRow, $objColumn) {
        if (is_null($intIdIdAccount)) {
            return '';
        }
        $objAuthAccount = AuthAccount::LoadById($intIdIdAccount);
        if (is_null($objAuthAccount)) {
            return 'error';
        }
        $lnkView = new MJaxLinkButton($this);
        $lnkView->Text = $objAuthAccount->__toString();
        $lnkView->Href = '/data/editAuthAccount?' . FFSQS::AuthAccount_IdAccount . '=' . $objAuthAccount->IdAccount;
        return $lnkView->Render(false);
    }
}
?>