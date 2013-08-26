<?php
class FFSAtheleteSelectPanel extends MJaxPanel{
    /*
     * NOTES: Consider adding advanced options
     * --- Search by birthdate between X
     * --- Level
     * --- Etc
     */

    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
       
    }
    
}