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
   		
	
	
   		public $lnkViewParentIdDevice = null;
	
   		public $lnkViewParentIdSession = null;
	
	
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
		$this->btnSave->AddCssClass('btn btn-large');
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		$this->btnDelete->AddCssClass('btn btn-large');
		if(is_null($this->objAssignment)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
  		
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strEvent = new MJaxTextBox($this);
                $this->strEvent->Name = 'event';
                $this->strEvent->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strApartatus = new MJaxTextBox($this);
                $this->strApartatus->Name = 'apartatus';
                $this->strApartatus->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttRevokeDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	  
	  if(!is_null($this->objAssignment)){
            $this->SetAssignment($this->objAssignment);
	  }
  }
  public function SetAssignment($objAssignment){
      $this->objAssignment = $objAssignment;
      $this->blnModified = true;
      if(!is_null($this->objAssignment)){
          
            
            
                //PKey
                $this->intIdAssignment = $this->objAssignment->idAssignment;
            

          
            
                
                
            
            

          
            
                
                
            
            

          
            
                
                    $this->strEvent->Text = $this->objAssignment->event;
                
                
            
            

          
            
                
                    $this->strApartatus->Text = $this->objAssignment->apartatus;
                
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttRevokeDate->Value = $this->objAssignment->revokeDate;
                    
                
            
            

          
      }

	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAssignment)){
          
            if(!is_null($this->objAssignment->idDevice)){
                $this->lnkViewParentIdDevice = new MJaxLinkButton($this);
                $this->lnkViewParentIdDevice->Text = 'View Device';
                $this->lnkViewParentIdDevice->Href = __ENTITY_MODEL_DIR__ . '/Device/' . $this->objAssignment->idDevice;
            }
          
            if(!is_null($this->objAssignment->idSession)){
                $this->lnkViewParentIdSession = new MJaxLinkButton($this);
                $this->lnkViewParentIdSession->Text = 'View Session';
                $this->lnkViewParentIdSession->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objAssignment->idSession;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objAssignment)){
			//Create a new one
			$this->objAssignment = new Assignment();
		}

  		  
            
		  
            
                
                
            
		  
            
                
                
            
		  
            
                
                    $this->objAssignment->event = $this->strEvent->Text;
                
                
            
		  
            
                
                    $this->objAssignment->apartatus = $this->strApartatus->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objAssignment->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		
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