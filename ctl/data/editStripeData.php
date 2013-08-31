<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - StripeDataManageForm extends StripeDataManageFormBase
*/
class StripeDataManageForm extends StripeDataManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrStripeDatas = $this->Query();
        $objStripeData = null;
        if (count($arrStripeDatas) == 1) {
            $objStripeData = $arrStripeDatas[0];
        }
        $this->InitEditPanel($objStripeData);
        $this->InitList($arrStripeDatas);
        $this->pnlBreadcrumb->AddCrumb('Manage StripeDatas');
    }
}
StripeDataManageForm::Run('StripeDataManageForm');
