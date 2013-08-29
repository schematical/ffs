<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - ParentMessageManageForm extends ParentMessageManageFormBase
*/
class ParentMessageManageForm extends ParentMessageManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrParentMessages = $this->Query();
        $objParentMessage = null;
        if (count($arrParentMessages) == 1) {
            $objParentMessage = $arrParentMessages[0];
        }
        $this->InitEditPanel($objParentMessage);
        $this->InitList($arrParentMessages);
    }
}
ParentMessageManageForm::Run('ParentMessageManageForm');
