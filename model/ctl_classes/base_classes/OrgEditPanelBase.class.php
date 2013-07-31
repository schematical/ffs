<?php
class OrgEditPanelBase extends MJaxPanel{
	protected $objOrg = null;
    
    	
    	public $intIdOrg = null;
   		
    	
	
    	
    	
    	public $strNamespace = null;
   		
	
    	
    	
    	public $strName = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objOrg = null){
		parent::__construct($objParentControl);
		$this->objOrg = $objOrg;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/OrgEditPanelBase.tpl.php';
		
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
		if(is_null($this->objOrg)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->strNamespace = new MJaxTextBox($this);
	  		$this->strNamespace->Name = 'namespace';
	  		$this->strNamespace->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strName = new MJaxTextBox($this);
	  		$this->strName->Name = 'name';
	  		$this->strName->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttCreDate = new MJaxTextBox($this);
	  		$this->dttCreDate->Name = 'creDate';
	  		$this->dttCreDate->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objOrg)){
	     
	  	
  		
  			$this->intIdOrg = $this->objOrg->idOrg;
  		
  		
	     
	  	
            
	  		    $this->strNamespace->Text = $this->objOrg->namespace;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strName->Text = $this->objOrg->name;
            
            
  		
  		
  		
	     
	  	
            
            
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objOrg->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objOrg)){
			//Create a new one
			$this->objOrg = new Org();
		}

  		  
  		
		  
  		
      	$this->objOrg->namespace = $this->strNamespace->Text;
		
		  
  		
      	$this->objOrg->name = $this->strName->Text;
		
		  
  		
      	$this->objOrg->creDate = $this->dttCreDate->Text;
		
		
		$this->objOrg->Save();
  	}
  	public function btnDelete_click(){
  		$this->objOrg->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objOrg);
  	}
  	
}
?>