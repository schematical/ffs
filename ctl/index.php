<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - About extends AboutBase
*/

class index extends FFSForm {
    public $pnlTest = null;
    public function Form_Create(){
        parent::Form_Create();
        /*if(!is_null(MDEAuthDriver::User())){
            $this->Redirect('/home.php');
       } */
       //$this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/index.tpl.php';
        $this->pnlTest = new AssignmentEditPanel($this);
        $this->AddWidget('Edit User', '', $this->pnlTest);
    }
}
index::Run('index');
?>