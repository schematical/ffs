<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/ParentMessageEditPanelBase.class.php");
class ParentMessageEditPanel extends ParentMessageEditPanelBase {

    public function __construct($objParentControl, $objParentMessage = null){
		parent::__construct($objParentControl, $objParentMessage);
        if(!is_null($this->objParentMessage)){
            if(is_null($this->objParentMessage->QueDate)){
                //Message has not been created yet
                $this->btnSave->Text = 'Send';
            }else{
                //Message has been created
                $this->btnSave->Remove();
                $this->btnSave = null;
                if(is_null($this->objParentMessage->DispDate)){
                    //Message has not been shown
                    //Posibly show estimated count down
                }else{
                    //Message has been shown
                    //Show disp date
                }
            }
        }else{
            $this->btnSave->Text = 'Send';
        }
    }
    public function btnSave_click(){
        parent::btnSave_click();
        if(is_null($this->objParentMessage->QueDate)){
            //This is new message to be sent
            $this->objParentMessage->QueDate = MLCDateTime::Now();
            $this->objParentMessage->Save();
        }
        $this->objParentControl->pnlParentMessage_save($this->objParentMessage);
        return;
    }



}


?>