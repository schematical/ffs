<?php
class DeviceEditPanelBase extends MJaxPanel{
	protected $objDevice = null;
    
    	
    	public $intIdDevice = null;
   		
    	
	
    	
    	
    	public $strName = null;
   		
	
    	
    	
    	public $strToken = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $strInviteEmail = null;
   		
	
	
	
  		public $lnkViewChildAssignment = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objDevice = null){
		parent::__construct($objParentControl);
		$this->objDevice = $objDevice;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/DeviceEditPanelBase.tpl.php';
		
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
		if(is_null($this->objDevice)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strName = new MJaxTextBox($this);
                $this->strName->Name = 'name';
                $this->strName->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strToken = new MJaxTextBox($this);
                $this->strToken->Name = 'token';
                $this->strToken->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
                $this->strInviteEmail = new MJaxTextBox($this);
                $this->strInviteEmail->Name = 'inviteEmail';
                $this->strInviteEmail->AddCssClass('input-large');
                //varchar(45)
                
            
	  		
  		
	  
	  if(!is_null($this->objDevice)){
	     
	  	
  		
  			$this->intIdDevice = $this->objDevice->idDevice;
  		
  		
	     
	  	
            
	  		    $this->strName->Text = $this->objDevice->name;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strToken->Text = $this->objDevice->token;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->strInviteEmail->Text = $this->objDevice->inviteEmail;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objDevice)){
          

	   }

           

            $this->lnkViewChildAssignment = new MJaxLinkButton($this);
            $this->lnkViewChildAssignment->Text = 'View Assignments';
            //I should really fix this
            //$this->lnkViewChildAssignment->Href = __ENTITY_MODEL_DIR__ . '/Device/' . $this->objDevice->idDevice . '/Assignments';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objDevice)){
			//Create a new one
			$this->objDevice = new Device();
		}

  		  
            
		  
            
                
                    $this->objDevice->name = $this->strName->Text;
                
                
            
		  
            
                
                    $this->objDevice->token = $this->strToken->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                    $this->objDevice->inviteEmail = $this->strInviteEmail->Text;
                
                
            
		
		$this->objDevice->Save();
  	}
  	public function btnDelete_click(){
  		$this->objDevice->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objDevice);
  	}
  	
}
?>