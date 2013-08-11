<?php
class FFSPTFImportPanel extends MJaxPanel{
    public $uplImport = null;

    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->uplImport = new MJaxUploadBox($this);
        $this->uplImport->AddAction(
            new MJaxUploadEvent(),
            new MJaxServerControlAction(
                $this,
                'uplImport_upload'
            )
        );

    }
    public function uplImport_upload(){
        //_dv($this->uplImport->FileData);
        $strLocation = $this->uplImport->FileData['tmp_name'];

        FFSApplication::ImportPTF($strLocation);
        $this->objForm->HideAlert();
    }
    
}