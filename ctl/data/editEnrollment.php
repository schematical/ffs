<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - EnrollmentManageForm extends EnrollmentManageFormBase
*/
class EnrollmentManageForm extends EnrollmentManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrEnrollments = $this->Query();
        $objEnrollment = null;
        if (count($arrEnrollments) == 1) {
            $objEnrollment = $arrEnrollments[0];
        }
        $this->InitEditPanel($objEnrollment);
        $this->InitList($arrEnrollments);
    }
}
EnrollmentManageForm::Run('EnrollmentManageForm');
