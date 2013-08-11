<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/ParentMessageListPanelBase.class.php");
class ParentMessageListPanel extends ParentMessageListPanelBase {

    public function __construct($objParentControl, $arrParentMessages = array()){

		parent::__construct($objParentControl, $arrParentMessages);
        $this->AddCssClass('table table-striped table-bordered');
        foreach($this->Rows as $intIndex => $objRow){
            $lnkRow = new MJaxLinkButton($objRow);
            $lnkRow->AddCssClass('btn btn-error');
            $lnkRow->Text = 'Remove';
            $objRow->AddData(
                $lnkRow, 'remove'
            );
        }
        $this->AddColumn('remove','remove');

	}

	public function SetupCols(){
            $this->AddColumn('atheleteName','atheleteName');
            $this->AddColumn('message','message');

    }



}


?>