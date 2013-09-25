<?php
MLCApplication::InitPackage('MLCNotification');
class FFSNotificationBase extends MLCNotificationObjectBase{
    protected $arrData = array();
    public function __construct($objNotification = null){
        parent::__construct($objNotification);

        $this->strEmailTemplate = __PM_CORE__ . '/email/FFSNotificationBase.tpl.php';
    }
    public function GetData(){
        $arrData = parent::GetData();
        $arrData = array_merge($arrData, $this->arrData);
        return $arrData;
    }
    public function SetData($arrData){
        $this->arrData = $arrData;
    }

}