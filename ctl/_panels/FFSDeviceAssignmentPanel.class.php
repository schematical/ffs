<?php
class FFSDeviceAssignmentPanel extends MJaxPanel{

    public $txtDeviceName = null;

    public $lstSession = null;
    public $lstEvent = null;
    public $lnkAddInput = null;
    public function __construct($objParentControl, $objDevice = null){
        parent::__construct($objParentControl);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtDeviceName = new MJaxTextBox($this);
        $this->txtDeviceName->Attr('placeholder',"Device");
        $this->txtDeviceName->Typehead($this, '_searchDevice');

        $this->lstSession = new MJaxListBox($this);
        $arrSessions = FFSForm::$objCompetition->GetSessionArr()->getCollection();
        foreach($arrSessions as $intIndex => $objSession){
            $this->lstSession->AddItem($objSession->Name, $objSession->IdSession);
        }
        $this->lstSession->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'lstSession_change'
            )
        );
        $this->lstEvent = new MJaxListBox($this);
        $this->lnkAddInput = new MJaxLinkButton($this);
        $this->lnkAddInput->Text = 'Add Input';
        $this->lnkAddInput->AddCssClass('btn btn-large');
        $this->lnkAddInput->AddAction($this, 'lnkAddInput_click');


    }
    public function lnkAddInput_click(){

        $strContactData = $this->txtDeviceName->Text;
        if(filter_var($strContactData, FILTER_VALIDATE_EMAIL)){
            //Load Device by email
            $objDevice = Device::Query(
                sprintf(
                    'WHERE inviteEmail = "%s"',
                    $strContactData
                ),
                true
            );
            if(is_null($objDevice)){
                $objDevice = FFSApplication::InviteDevice($strContactData);
            }
        }else{
            //Load Device by name
            $objDevice = Device::Query(
                sprintf(
                    'WHERE inviteEmail = "%s"',
                    $strContactData
                ),
                true
            );
        }
        //_dv($objDevice);
        if(is_null($objDevice)){
            //Trigger error at this point
            return $this->txtDeviceName->Alert("Could not find a device with this info");
        }


        //TODO: Put check to test for multiple devices assigned
        $objAssignment = new Assignment();
        $objAssignment->IdSession = $this->lstSession->SelectedValue;
        $objAssignment->IdDevice = $objDevice->IdDevice;
        $objAssignment->CreDate = MLCDateTime::Now();
        $objAssignment->Event = $this->lstEvent->SelectedValue;
        $objAssignment->Save();

    }
    public function lstSession_change(){
        $this->lstEvent->RemoveAllItems();
        $objSession = Session::LoadById($this->lstSession->SelectedValue);
        //$objSession->Events(FFSEventData::$MENS_ARTISTIC_GYMNASTICS);
        $arrEvents = $objSession->Events();
        foreach($arrEvents as $strKey => $strEventName){
            $this->lstEvent->AddItem($strEventName, $strKey);
        }
    }
    public function _searchDevice($objRoute){
        $strSearch = $_POST['search'];
        $arrDevices = FFSApplication::GetDevicesByCompetiton();
        $arrDeviceNames = array();
        foreach($arrDevices as $intIndex => $objDevice){
            if(!is_null($objDevice->Name)){
                $arrDeviceNames[] = $objDevice->Name;
            }
        }
        foreach($arrDevices as $intIndex => $objDevice){
            $arrDeviceNames[] = $objDevice->InviteEmail;
        }
        die(
            json_encode(
                $arrDeviceNames
            )
        );
    }
    
}