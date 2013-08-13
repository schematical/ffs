<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/ParentMessageListPanelBase.class.php");
class ParentMessageListPanel extends ParentMessageListPanelBase {

    public function __construct($objParentControl, $arrParentMessages = array()){

		parent::__construct($objParentControl, $arrParentMessages);

        $this->AddCssClass('table table-striped table-bordered');
        foreach($this->Rows as $intIndex => $objRow){
            $objRow->RemoveAllActions('click');
            $lnkRemove = new MJaxLinkButton($objRow);
            $lnkRemove->AddCssClass('btn btn-error');
            $lnkRemove->Text = 'Remove';
            $lnkRemove->ActionParameter = $objRow->ActionParameter;
            $lnkRemove->AddAction($this,'lnkRemove_click');
            $objRow->AddData(
                $lnkRemove, 'remove'
            );
        }

        $this->AddColumn('remove','Remove');
        //_dv(array_keys($this->Rows));
        //_dv(array_keys($this->Rows['c7']->GetData()));

	}
    public function lnkRemove_click($strFormId, $strControlId, $strActionParameter){
        //_dv($strActionParameter);
        $objParentMessage = ParentMessage::LoadById($strActionParameter);
        FFSApplication::UnqueMessage($objParentMessage);
        foreach($this->Rows as $intIndex => $objRow){
            if($objRow->ActionParameter == $strActionParameter){
                $objRow->Remove();
                //unset($this->Rows[$intIndex]);
                $this->blnModified = true;
                return;
            }
        }

    }
	public function SetupCols(){
            $this->AddColumn('atheleteName','Name');
            $this->AddColumn('message','Message');

    }



}


?>