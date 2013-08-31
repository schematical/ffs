<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthUserTypeCd_tpcdManageForm extends AuthUserTypeCd_tpcdManageFormBase
*/
class AuthUserTypeCd_tpcdManageForm extends AuthUserTypeCd_tpcdManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthUserTypeCd_tpcds = $this->Query();
        $objAuthUserTypeCd_tpcd = null;
        if (count($arrAuthUserTypeCd_tpcds) == 1) {
            $objAuthUserTypeCd_tpcd = $arrAuthUserTypeCd_tpcds[0];
        }
        $this->InitEditPanel($objAuthUserTypeCd_tpcd);
        $this->InitList($arrAuthUserTypeCd_tpcds);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthUserTypeCd_tpcds');
    }
}
AuthUserTypeCd_tpcdManageForm::Run('AuthUserTypeCd_tpcdManageForm');
