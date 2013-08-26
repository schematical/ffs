<?php
class FFSDeviceAssignmentPanel extends MJaxPanel{

    public $txtDeviceName = null;

    public $lstSession = null;
    public $lstEvent = null;
    public $lnkAddInput = null;
    public function __construct($objParentControl, $objDevice = null){
        parent::__construct($objParentControl);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->txtDeviceName = new MJaxBSAutocompleteTextBox($this, $this, '_searchDevice');
        $this->txtDeviceName->Attr('placeholder',"Device");


        $this->lstSession = new MJaxListBox($this);
        $arrSessions = FFSForm::$objCompetition->GetSessionArr()->getCollection();
        $intFormIdSession = -1000;
        if(!is_null(FFSForm::$objSession)){
            $intFormIdSession = FFSForm::$objSession->IdSession;
        }
        foreach($arrSessions as $intIndex => $objSession){
            $this->lstSession->AddItem(
                $objSession->Name,
                $objSession->IdSession,
                ($objSession->IdSession == $intFormIdSession)

            );
        }

        $this->lstSession->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'lstSession_change'
            )
        );
        $this->lstEvent = new MJaxListBox($this);
        $this->lstEvent->Style->Width = '80%';
        $this->lnkAddInput = new MJaxLinkButton($this);
        $this->lnkAddInput->Text = 'Add Input';
        $this->lnkAddInput->AddCssClass('btn');
        $this->lnkAddInput->AddAction($this, 'lnkAddInput_click');

        if(!is_null(FFSForm::$objSession)){
            $this->RefreshEvents();
        }

    }
    public function lnkAddInput_click(){

        $objDevice = null;
        $strContactData = $this->txtDeviceName->Value;
        if(is_numeric($strContactData)){
            $objDevice = $strContactData;
        }elseif(filter_var($strContactData, FILTER_VALIDATE_EMAIL)){
            //Load Device by email

            $objDevice = FFSApplication::InviteDevice($strContactData);

        }
        //_dv($objDevice);
        if(is_null($objDevice)){
            //Trigger error at this point
            return $this->txtDeviceName->Alert("Could not find a device with this info");
        }

        $objAssignment = Assignment::Query(
            sprintf(
                'WHERE idDevice = %s AND idSession = %s',
                $objDevice->IdDevice,
                $this->lstSession->SelectedValue
            ),
            true
        );
        if(!is_null($objAssignment)){
            return $this->Alert("This device already has an assignment this session");
        }
        //TODO: Put check to test for multiple devices assigned
        $objAssignment = new Assignment();
        $objAssignment->IdSession = $this->lstSession->SelectedValue;
        $objAssignment->IdDevice = $objDevice->IdDevice;
        $objAssignment->CreDate = MLCDateTime::Now();
        $objAssignment->Event = $this->lstEvent->SelectedValue;
        $objAssignment->Save();
        MLCApplication::InitPackage('MLCPostmark');
        $objEmail = MLCPostmarkDriver::ComposeFromTemplate(
            __ASSETS_ACTIVE_APP_DIR__ . '/email/AssignmentInvite.email.php',
            array(
                'ASSIGNMENT' => $objAssignment
            )
        );
        $objEmail->addTo(
            $objDevice->InviteEmail
        );
        $objEmail->Subject('You have been invited to help at the ' . FFSForm::$objCompetition->Name);
        $objEmail->Send();
        $this->Alert("Invite Sent");

    }
    public function lstSession_change(){
        $this->RefreshEvents();
    }
    public function RefreshEvents(){
        $this->lstEvent->RemoveAllItems();
        $objSession = Session::LoadById($this->lstSession->SelectedValue);
        //$objSession->Events(FFSEventData::$MENS_ARTISTIC_GYMNASTICS);
        $arrEvents = $objSession->Events();
        //_dv($arrEvents);
        foreach($arrEvents as $strKey => $strEventName){
            $this->lstEvent->AddItem($strEventName, $strKey);
        }
    }
    public function _searchDevice($objRoute){
        $strSearch = $_POST['search'];
        $arrDevices = FFSApplication::GetDevicesByOrg(
            null,
            $strSearch
        );
        $arrDeviceNames = array();
        foreach($arrDevices as $intIndex => $objDevice){
            if(!is_null($objDevice->Name)){
                $arrDeviceNames[] = array(
                    'value'=>$objDevice->IdDevice,
                    'text'=>$objDevice->Name
                );
            }
        }
        foreach($arrDevices as $intIndex => $objDevice){
            $arrDeviceNames[] = array(
                'value'=>$objDevice->IdDevice,
                'text'=>$objDevice->InviteEmail
            );
        }
        if(count($arrDeviceNames) == 0){
            if(filter_var($strSearch, FILTER_VALIDATE_EMAIL)){
                $arrDeviceNames  = array(
                    'value'=>$strSearch,
                    'text'=>'Invite ' . $strSearch
                );
            }else{
                $arrDeviceNames  = array(
                    'value'=>-1,
                    'text'=>'Invite by email'
                );
            }
        }
        die(
            json_encode(
                $arrDeviceNames
            )
        );
    }
    
}