<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - TrackingEventManageForm extends TrackingEventManageFormBase
*/
class TrackingEventManageForm extends TrackingEventManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrTrackingEvents = $this->Query();
        $objTrackingEvent = null;
        if (count($arrTrackingEvents) == 1) {
            $objTrackingEvent = $arrTrackingEvents[0];
        }
        $this->InitEditPanel($objTrackingEvent);
        $this->InitList($arrTrackingEvents);
        $this->pnlBreadcrumb->AddCrumb('Manage TrackingEvents');
    }
}
TrackingEventManageForm::Run('TrackingEventManageForm');
