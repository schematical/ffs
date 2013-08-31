<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - txtSearch_change()
* - GetExtQuery()
* - GetValue()
* Classes list:
* - MLCNotificationSelectPanelBase extends MJaxPanel
*/
class MLCNotificationSelectPanelBase extends MJaxPanel {
    protected $arrSelectedMLCNotifications = array();
    public $txtSearch = null;
    //public $tblMLCNotifications = null;
    public $intIdNotification = null;
    public $intIdUser = null;
    public $strClassName = null;
    public $strData = null;
    public $intViewed = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/ctl_panels/' . get_class($this) . '.tpl.php';
        $this->txtSearch = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchMLCNotification');
        $this->txtSearch->Name = 'idMLCNotification';
        $this->txtSearch->AddCssClass('input-large');
        $this->txtSearch->AddAction(new MJaxChangeEvent() , new MJaxServerControlAction($this, 'txtSearch_change'));
        $this->intIdNotification = new MJaxTextBox($this);
        $this->intIdNotification->Attr('placeholder', " Notification");
        $this->intIdUser = new MJaxTextBox($this);
        $this->intIdUser->Attr('placeholder', " User");
        $this->strClassName = new MJaxTextBox($this);
        $this->strClassName->Attr('placeholder', " Class Name");
        $this->strData = new MJaxTextBox($this);
        $this->strData->Attr('placeholder', " Data");
        $this->intViewed = new MJaxTextBox($this);
        $this->intViewed->Attr('placeholder', " Viewed");
    }
    public function txtSearch_change() {
        $objEntity = null;
        $arrParts = explode('_', $this->txtSearch->Value);
        if (count($arrParts) < 2) {
            //IDK
            $this->arrSelectedMLCNotifications = array();
            return;
        }
        try {
            if (class_exists($arrParts[0])) {
                $objEntity = call_user_func($arrParts[0] . '::LoadById', $arrParts[1]);
            }
        }
        catch(Exception $e) {
            error_log($e->getMessage());
        }
        $arrMLCNotifications = array();
        if (is_null($objEntity)) {
            return $arrMLCNotifications;
        }
        switch (get_class($objEntity)) {
            case ('MLCNotification'):
                $arrMLCNotifications = array(
                    $objEntity
                );
            break;
            case ('AuthUser'):
                $arrAndConditions = $this->GetExtQuery();
                $arrAndConditions[] = sprintf(' idUser = %s', $objEntity->IdUser);
                $arrMLCNotifications = MLCNotification::Query(' WHERE ' . implode(' AND ', $arrAndConditions));
            break;
            default:
                array();
                throw new Exception("Invalid entity type: " . get_class($objEntity));
        }
        $this->arrSelectedMLCNotifications = $arrMLCNotifications;
        $this->TriggerEvent('change');
    }
    public function GetExtQuery() {
        $arrAndConditions = array();
        //Is special field!!!!!
        //Is special field!!!!!
        //Do nothing this is a creDate
        if (!is_null($this->strClassName->GetValue())) {
            $arrAndConditions[] = sprintf('className LIKE "%s%%"', $this->strClassName->GetValue());
        }
        //Is special field!!!!!
        if (!is_null($this->intViewed->GetValue())) {
            $arrAndConditions[] = sprintf('viewed LIKE "%s%%"', $this->intViewed->GetValue());
        }
        return $arrAndConditions;
    }
    public function GetValue() {
        return $this->arrSelectedMLCNotifications;
    }
}
