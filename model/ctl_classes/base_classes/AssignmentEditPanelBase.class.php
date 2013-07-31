<?php
class AssignmentEditPanelBase extends MJaxPanel{
	protected $objAssignment = null;
    
    	
    	public $intIdAssignment = null;
   		
    	
	
    	
    	
    	public $intIdDevice = null;
   		
	
    	
    	
    	public $intIdSession = null;
   		
	
    	
    	
    	public $strEvent = null;
   		
	
    	
    	
    	public $strApartatus = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $dttRevokeDate = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAssignment = null){
		parent::__construct($objParentControl);
		$this->objAssignment = $objAssignment;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AssignmentEditPanelBase.tpl.php';
		
		$this->CreateFieldControls();
		$this->CreateContentControls();
		$this->CreateReferenceControls();
		
	}
	public function CreateContentControls(){
		$this->btnSave = new MJaxButton($this);
		$this->btnSave->Text = 'Save';
		$this->btnSave->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnSave_click'));
		
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		if(is_null($this->objAssignment)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->intIdDevice = new MJaxTextBox($this);
	  		$this->intIdDevice->Name = 'idDevice';
	  		$this->intIdDevice->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdSession = new MJaxTextBox($this);
	  		$this->intIdSession->Name = 'idSession';
	  		$this->intIdSession->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strEvent = new MJaxTextBox($this);
	  		$this->strEvent->Name = 'event';
	  		$this->strEvent->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strApartatus = new MJaxTextBox($this);
	  		$this->strApartatus->Name = 'apartatus';
	  		$this->strApartatus->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttCreDate = new MJaxTextBox($this);
	  		$this->dttCreDate->Name = 'creDate';
	  		$this->dttCreDate->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdUser = new MJaxTextBox($this);
	  		$this->intIdUser->Name = 'idUser';
	  		$this->intIdUser->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttRevokeDate = new MJaxTextBox($this);
	  		$this->dttRevokeDate->Name = 'revokeDate';
	  		$this->dttRevokeDate->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objAssignment)){
	     
	  	
  		
  			$this->intIdAssignment = $this->objAssignment->idAssignment;
  		
  		
	     
	  	
            
	  		    $this->intIdDevice->Text = $this->objAssignment->idDevice;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdSession->Text = $this->objAssignment->idSession;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strEvent->Text = $this->objAssignment->event;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strApartatus->Text = $this->objAssignment->apartatus;
            
            
  		
  		
  		
	     
	  	
            
            
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdUser->Text = $this->objAssignment->idUser;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->dttRevokeDate->Text = $this->objAssignment->revokeDate;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objAssignment->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objAssignment)){
			//Create a new one
			$this->objAssignment = new Assignment();
		}

  		  
  		
		  
  		
      	$this->objAssignment->idDevice = $this->intIdDevice->Text;
		
		  
  		
      	$this->objAssignment->idSession = $this->intIdSession->Text;
		
		  
  		
      	$this->objAssignment->event = $this->strEvent->Text;
		
		  
  		
      	$this->objAssignment->apartatus = $this->strApartatus->Text;
		
		  
  		
      	$this->objAssignment->creDate = $this->dttCreDate->Text;
		
		  
  		
      	$this->objAssignment->idUser = $this->intIdUser->Text;
		
		  
  		
      	$this->objAssignment->revokeDate = $this->dttRevokeDate->Text;
		
		
		$this->objAssignment->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAssignment->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAssignment);
  	}
  	
}
?>