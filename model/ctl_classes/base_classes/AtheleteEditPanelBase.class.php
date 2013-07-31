<?php
class AtheleteEditPanelBase extends MJaxPanel{
	protected $objAthelete = null;
    
    	
    	public $intIdAthelete = null;
   		
    	
	
    	
    	
    	public $intIdOrg = null;
   		
	
    	
    	
    	public $strFirstName = null;
   		
	
    	
    	
    	public $strLastName = null;
   		
	
    	
    	
    	public $dttBirthDate = null;
   		
	
	
	
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
		
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		if(is_null($this->objAthelete)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->intIdOrg = new MJaxTextBox($this);
	  		$this->intIdOrg->Name = 'idOrg';
	  		$this->intIdOrg->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strFirstName = new MJaxTextBox($this);
	  		$this->strFirstName->Name = 'firstName';
	  		$this->strFirstName->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strLastName = new MJaxTextBox($this);
	  		$this->strLastName->Name = 'lastName';
	  		$this->strLastName->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttBirthDate = new MJaxTextBox($this);
	  		$this->dttBirthDate->Name = 'birthDate';
	  		$this->dttBirthDate->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objAthelete)){
	     
	  	
  		
  			$this->intIdAthelete = $this->objAthelete->idAthelete;
  		
  		
	     
	  	
            
	  		    $this->intIdOrg->Text = $this->objAthelete->idOrg;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strFirstName->Text = $this->objAthelete->firstName;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strLastName->Text = $this->objAthelete->lastName;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->dttBirthDate->Text = $this->objAthelete->birthDate;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objAthelete->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objAthelete)){
			//Create a new one
			$this->objAthelete = new Athelete();
		}

  		  
  		
		  
  		
      	$this->objAthelete->idOrg = $this->intIdOrg->Text;
		
		  
  		
      	$this->objAthelete->firstName = $this->strFirstName->Text;
		
		  
  		
      	$this->objAthelete->lastName = $this->strLastName->Text;
		
		  
  		
      	$this->objAthelete->birthDate = $this->dttBirthDate->Text;
		
		
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