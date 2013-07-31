<?php
class SessionEditPanelBase extends MJaxPanel{
	protected $objSession = null;
    
    	
    	public $intIdSession = null;
   		
    	
	
    	
    	
    	public $dttStartDate = null;
   		
	
    	
    	
    	public $dttEndDate = null;
   		
	
    	
    	
    	public $intIdCompetition = null;
   		
	
    	
    	
    	public $strName = null;
   		
	
    	
    	
    	public $strNotes = null;
   		
	
    	
    	
    	public $strData = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objSession = null){
		parent::__construct($objParentControl);
		$this->objSession = $objSession;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/SessionEditPanelBase.tpl.php';
		
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
		if(is_null($this->objSession)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->dttStartDate = new MJaxTextBox($this);
	  		$this->dttStartDate->Name = 'startDate';
	  		$this->dttStartDate->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttEndDate = new MJaxTextBox($this);
	  		$this->dttEndDate->Name = 'endDate';
	  		$this->dttEndDate->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdCompetition = new MJaxTextBox($this);
	  		$this->intIdCompetition->Name = 'idCompetition';
	  		$this->intIdCompetition->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strName = new MJaxTextBox($this);
	  		$this->strName->Name = 'name';
	  		$this->strName->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strNotes = new MJaxTextBox($this);
	  		$this->strNotes->Name = 'notes';
	  		$this->strNotes->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strData = new MJaxTextBox($this);
	  		$this->strData->Name = 'data';
	  		$this->strData->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objSession)){
	     
	  	
  		
  			$this->intIdSession = $this->objSession->idSession;
  		
  		
	     
	  	
            
	  		    $this->dttStartDate->Text = $this->objSession->startDate;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->dttEndDate->Text = $this->objSession->endDate;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdCompetition->Text = $this->objSession->idCompetition;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strName->Text = $this->objSession->name;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strNotes->Text = $this->objSession->notes;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strData->Text = $this->objSession->data;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objSession->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objSession)){
			//Create a new one
			$this->objSession = new Session();
		}

  		  
  		
		  
  		
      	$this->objSession->startDate = $this->dttStartDate->Text;
		
		  
  		
      	$this->objSession->endDate = $this->dttEndDate->Text;
		
		  
  		
      	$this->objSession->idCompetition = $this->intIdCompetition->Text;
		
		  
  		
      	$this->objSession->name = $this->strName->Text;
		
		  
  		
      	$this->objSession->notes = $this->strNotes->Text;
		
		  
  		
      	$this->objSession->data = $this->strData->Text;
		
		
		$this->objSession->Save();
  	}
  	public function btnDelete_click(){
  		$this->objSession->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objSession);
  	}
  	
}
?>