<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthUserSettingTypeCd_tpcdManageForm extends AuthUserSettingTypeCd_tpcdManageFormBase
*/
class AuthUserSettingTypeCd_tpcdManageForm extends AuthUserSettingTypeCd_tpcdManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthUserSettingTypeCd_tpcds = $this->Query();
        $objAuthUserSettingTypeCd_tpcd = null;
        if (count($arrAuthUserSettingTypeCd_tpcds) == 1) {
            $objAuthUserSettingTypeCd_tpcd = $arrAuthUserSettingTypeCd_tpcds[0];
        }
        $this->InitEditPanel($objAuthUserSettingTypeCd_tpcd);
        $this->InitList($arrAuthUserSettingTypeCd_tpcds);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthUserSettingTypeCd_tpcds');
    }
}
AuthUserSettingTypeCd_tpcdManageForm::Run('AuthUserSettingTypeCd_tpcdManageForm');
