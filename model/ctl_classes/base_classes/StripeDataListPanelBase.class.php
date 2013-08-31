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
* Classes list:
* - StripeDataListPanelBase extends MJaxTable
*/
class StripeDataListPanelBase extends MJaxTable {
    public function __construct($objParentControl, $arrStripeDatas = array()) {
        parent::__construct($objParentControl);
        $this->SetupCols();
        $this->SetDataEntites($arrStripeDatas);
    }
    public function InitRemoveButtons($strText = 'Remove', $strCssClasses = 'btn btn-error') {
        $this->InitRowControl('remove', $strText, $this, 'lnkRemove_click', $strCssClasses);
    }
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter) {
        //_dv($strActionParameter);
        $objStripeData = StripeData::LoadById($strActionParameter);
        if (!is_null($objStripeData)) {
            $objStripeData->markDeleted();
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
        //$this->AddColumn('idStripeData','idStripeData');
        $this->AddColumn('object', ' Object', null, null, 'MJaxTextArea');
        $this->AddColumn('idAuthUser', ' Auth User', null, null, 'MJaxTextBox');
        $this->AddColumn('mode', ' Mode', null, null, 'MJaxTextBox');
        $this->AddColumn('instance_url', ' Instance _url', null, null, 'MJaxTextBox');
        $this->AddColumn('stripeId', ' Stripe Id', null, null, 'MJaxTextBox');
    }
}
?>