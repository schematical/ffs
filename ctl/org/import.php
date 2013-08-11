<?php

class import extends FFSForm {
    public $uplImport = null;

    public function Form_Create(){
        parent::Form_Create();
        if(is_null(MLCAuthDriver::User())){
            $this->Redirect('/index.php');
        }
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/org/import.tpl.php';

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
        //$strLocation = $this->uplImport->FileData['tmp_name'];
        $strLocation = '/var/www/FFS/sample.ptf';
        FFSApplication::ImportPTF($strLocation);
    }

}
import::Run('import');
?>