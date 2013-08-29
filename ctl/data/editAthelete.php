<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AtheleteManageForm extends AtheleteManageFormBase
*/
class AtheleteManageForm extends AtheleteManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAtheletes = $this->Query();
        $objAthelete = null;
        if (count($arrAtheletes) == 1) {
            $objAthelete = $arrAtheletes[0];
        }
        $this->InitEditPanel($objAthelete);
        $this->InitList($arrAtheletes);
    }
}
AtheleteManageForm::Run('AtheleteManageForm');
