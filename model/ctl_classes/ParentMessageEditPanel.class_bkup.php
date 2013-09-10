<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/ParentMessageEditPanelBase.class.php");
class ParentMessageEditPanel extends ParentMessageEditPanelBase {
    protected $blnAllowSave = true;

    public $txtUsername = null;
    public function __construct($objParentControl, $objParentMessage = null){
		parent::__construct($objParentControl, $objParentMessage);
        $this->txtUsername = new MJaxTextBox($this);
        $this->txtUsername->Attr('placeholder', 'From');
        //$this->txtUsername->AddCssClass('span10 offset1');
        $objUser = MLCAuthDriver::User();
        if(!is_null($objUser)){
            $this->txtUsername->Text = $objUser->Username;
        }
        //Load last athelete name
        $objUser = MLCAuthDriver::User();

        if(!is_null($objUser)){
            $objParentMessage = ParentMessage::Query(
                sprintf(
                    'WHERE idUser = %s AND atheleteName IS NOT NULL ORDER BY queDate DESC',
                    $objUser->IdUser
                ),
                true

            );
            if(!is_null($objParentMessage)){
                $this->strAtheleteName->Text = $objParentMessage->AtheleteName;
            }
        }

        //$this->strAtheleteName->AddCssClass('input-mlarge span10 offset1');
        //$this->strAtheleteName->Style->Padding = '24Px';
        $this->strMessage->Attr('maxlength', 256);
        //$this->btnSave->Style->Padding = '9Px';
        //$this->btnSave->AddCssClass('ParentMessageEditPanel_btnSave');
        //$this->btnSave->AddCssClass('span10 offset1 btn btn-large');
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
    public function SetAthelete(Athelete $objAthelete){
        $this->strAtheleteName = $objAthelete->FirstName . ' ' . $objAthelete->LastName;
        $this->objParentMessage->IdAthelete = $objAthelete->IdAthelete;
    }
    public function btnSave_click(){
        $objUser = MLCAuthDriver::User();
        if(!is_null($objUser)){
            $objUser->Username = $this->txtUsername->Text;
            $objUser->Save();
        }
        if($this->blnAllowSave){
            parent::btnSave_click();
            if(is_null($this->objParentMessage->QueDate)){
                //This is new message to be sent
                $this->objParentMessage->QueDate = MLCDateTime::Now();
                $this->objParentMessage->Save();
            }
        }
        $this->objForm->pnlParentMessage_save($this->objParentMessage);
        return;
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "AllowSave":
                return $this->blnAllowSave;

            default:
                return parent::__get($strName);

        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case('AllowSave'):
                return $this->blnAllowSave = $mixValue;
            default:
                return parent::__set($strName, $mixValue);

        }
    }

}


?>