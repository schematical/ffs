<?php
class AtheleteEditPanelBase extends MJaxPanel{
	protected $objAthelete = null;
    
    	
    	public $intIdAthelete = null;
   		
    	
	
    	
    	
    	public $intIdOrg = null;
   		
	
    	
    	
    	public $strFirstName = null;
   		
	
    	
    	
    	public $strLastName = null;
   		
	
    	
    	
    	public $dttBirthDate = null;
   		
	
	
   		public $lnkViewParentAthelete = null;
	
	
  		public $lnkViewChildResult = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAthelete = null){
		parent::__construct($objParentControl);
		$this->objAthelete = $objAthelete;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AtheleteEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAthelete)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strFirstName = new MJaxTextBox($this);
                $this->strFirstName->Name = 'firstName';
                $this->strFirstName->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strLastName = new MJaxTextBox($this);
                $this->strLastName->Name = 'lastName';
                $this->strLastName->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttBirthDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	  
	  if(!is_null($this->objAthelete)){
	     
	  	
  		
  			$this->intIdAthelete = $this->objAthelete->idAthelete;
  		
  		
	     
	  	
            
	  		    $this->intIdOrg->Text = $this->objAthelete->idOrg;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strFirstName->Text = $this->objAthelete->firstName;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strLastName->Text = $this->objAthelete->lastName;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
                    $this->dttBirthDate->Value = $this->objAthelete->birthDate;
                
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAthelete)){
          
            if(!is_null($this->objAthelete->idOrg)){
                $this->lnkViewParentAthelete = new MJaxLinkButton($this);
                $this->lnkViewParentAthelete->Text = 'View Org';
                $this->lnkViewParentAthelete->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objAthelete->idOrg;
            }
          

	   }

           

            $this->lnkViewChildResult = new MJaxLinkButton($this);
            $this->lnkViewChildResult->Text = 'View Results';
            //I should really fix this
            //$this->lnkViewChildResult->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objAthelete->idAthelete . '/Results';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objAthelete)){
			//Create a new one
			$this->objAthelete = new Athelete();
		}

  		  
            
		  
            
                
                
            
		  
            
                
                    $this->objAthelete->firstName = $this->strFirstName->Text;
                
                
            
		  
            
                
                    $this->objAthelete->lastName = $this->strLastName->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		
		$this->objAthelete->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAthelete->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAthelete);
  	}
  	
}
?>