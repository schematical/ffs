<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthAccountTypeCdManageForm extends AuthAccountTypeCdManageFormBase
*/
class AuthAccountTypeCdManageForm extends AuthAccountTypeCdManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthAccountTypeCds = $this->Query();
        $objAuthAccountTypeCd = null;
        if (count($arrAuthAccountTypeCds) == 1) {
            $objAuthAccountTypeCd = $arrAuthAccountTypeCds[0];
        }
        $this->InitEditPanel($objAuthAccountTypeCd);
        $this->InitList($arrAuthAccountTypeCds);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthAccountTypeCds');
    }
}
AuthAccountTypeCdManageForm::Run('AuthAccountTypeCdManageForm');
