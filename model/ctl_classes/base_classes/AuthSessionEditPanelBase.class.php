<?php
class AuthSessionEditPanelBase extends MJaxPanel{
	protected $objAuthSession = null;
    
    	
    	public $intIdSession = null;
   		
    	
	
    	
    	
    	public $dttStartDate = null;
   		
	
    	
    	
    	public $dttEndDate = null;
   		
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $strSessionKey = null;
   		
	
    	
    	
    	public $strIpAddress = null;
   		
	
	
   		//public $lnkViewParentAuthSession = null;
	
	
  		public $lnkViewChildTrackingEvent = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthSession = null){
		parent::__construct($objParentControl);
		$this->objAuthSession = $objAuthSession;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthSessionEditPanelBase.tpl.php';
		
		$this->CreateFieldControls();
		$this->CreateContentControls();
		$this->CreateReferenceControls();
		
	}
	public function CreateContentControls(){
		$this->btnSave = new MJaxButton($this);
		$this->btnSave->Text = 'Save';
		$this->btnSave->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnSave_click'));
		$this->btnSave->AddCssClass('btn btn-large');
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		$this->btnDelete->AddCssClass('btn btn-large');
		if(is_null($this->objAuthSession)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttStartDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttEndDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
                $this->strSessionKey = new MJaxTextBox($this);
                $this->strSessionKey->Name = 'sessionKey';
                $this->strSessionKey->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strIpAddress = new MJaxTextBox($this);
                $this->strIpAddress->Name = 'ipAddress';
                $this->strIpAddress->AddCssClass('input-large');
                //varchar(16)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthSession)){
	     
	  	
  		
  			$this->intIdSession = $this->objAuthSession->idSession;
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
                    $this->dttStartDate->Value = $this->objAuthSession->startDate;
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
                    $this->dttEndDate->Value = $this->objAuthSession->endDate;
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->strSessionKey->Text = $this->objAuthSession->sessionKey;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strIpAddress->Text = $this->objAuthSession->ipAddress;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthSession)){
          
            if(!is_null($this->objAuthSession->idUser)){
                $this->lnkViewParentAuthSession = new MJaxLinkButton($this);
                $this->lnkViewParentAuthSession->Text = 'View AuthUser';
                $this->lnkViewParentAuthSession->Href = __ENTITY_MODEL_DIR__ . '/AuthUser/' . $this->objAuthSession->idUser;
            }
          

	   }

           

            $this->lnkViewChildTrackingEvent = new MJaxLinkButton($this);
            $this->lnkViewChildTrackingEvent->Text = 'View TrackingEvents';
            //I should really fix this
            //$this->lnkViewChildTrackingEvent->Href = __ENTITY_MODEL_DIR__ . '/AuthSession/' . $this->objAuthSession->idSession . '/TrackingEvents';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthSession)){
			//Create a new one
			$this->objAuthSession = new AuthSession();
		}

  		  
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objAuthSession->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                    $this->objAuthSession->sessionKey = $this->strSessionKey->Text;
                
                
            
		  
            
                
                    $this->objAuthSession->ipAddress = $this->strIpAddress->Text;
                
                
            
		
		$this->objAuthSession->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthSession->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthSession);
  	}
  	
}
?>