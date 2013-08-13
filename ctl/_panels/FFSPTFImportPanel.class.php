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

        if(strtolower(pathinfo($this->uplImport->FileData['name'], PATHINFO_EXTENSION)) != 'ptf'){
            return $this->uplImport->Alert("Invalid file. Must have .ptf extension");
        }
        $strLocation = $this->uplImport->FileData['tmp_name'];

        FFSApplication::ImportPTF($strLocation);
        //_dv("Import Done");
        $this->objForm->TriggerControlEvent($this->ControlId, 'ffs-ptf-import');
    }
    
}