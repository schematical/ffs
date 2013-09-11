<?php
require_once(__MODEL_APP_CONTROL__ . "/base_classes/OrgEditPanelBase.class.php");
class OrgEditPanel extends OrgEditPanelBase {
    public $txtClubName = null;
    public function __construct($objParentControl, $objOrg = null) {
        parent::__construct($objParentControl, $objOrg);
        /*$this->intIdImportAuthUser->Remove();
        $this->intIdImportAuthUser = null;

        //IDK
        $this->strNamespace->Remove();
        $this->strNamespace = null;*/

    }

    public function ForceClubType($strType){
        $this->strClubType->Attr('readonly','readonly');
        $this->strClubType->Text = $strType;
    }

}


?>