<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AssignmentManageForm extends AssignmentManageFormBase
*/
class AssignmentManageForm extends AssignmentManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAssignments = $this->Query();
        $objAssignment = null;
        if (count($arrAssignments) == 1) {
            $objAssignment = $arrAssignments[0];
        }
        $this->InitEditPanel($objAssignment);
        $this->InitList($arrAssignments);
    }
}
AssignmentManageForm::Run('AssignmentManageForm');
