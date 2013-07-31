<?php
class EnrollmentEditPanelBase extends MJaxPanel{
	protected $objEnrollment = null;
    
    	
    	public $intIdEnrollment = null;
   		
    	
	
    	
    	
    	public $intIdAthelete = null;
   		
	
    	
    	
    	public $intIdCompetition = null;
   		
	
    	
    	
    	public $intIdSession = null;
   		
	
    	
    	
    	public $strFlight = null;
   		
	
    	
    	
    	public $strDivision = null;
   		
	
    	
    	
    	public $strAgeGroup = null;
   		
	
    	
    	
    	public $strMisc1 = null;
   		
	
    	
    	
    	public $strMisc2 = null;
   		
	
    	
    	
    	public $strMisc3 = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objEnrollment = null){
		parent::__construct($objParentControl);
		$this->objEnrollment = $objEnrollment;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/EnrollmentEditPanelBase.tpl.php';
		
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
		if(is_null($this->objEnrollment)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->intIdAthelete = new MJaxTextBox($this);
	  		$this->intIdAthelete->Name = 'idAthelete';
	  		$this->intIdAthelete->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdCompetition = new MJaxTextBox($this);
	  		$this->intIdCompetition->Name = 'idCompetition';
	  		$this->intIdCompetition->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdSession = new MJaxTextBox($this);
	  		$this->intIdSession->Name = 'idSession';
	  		$this->intIdSession->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strFlight = new MJaxTextBox($this);
	  		$this->strFlight->Name = 'flight';
	  		$this->strFlight->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strDivision = new MJaxTextBox($this);
	  		$this->strDivision->Name = 'division';
	  		$this->strDivision->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strAgeGroup = new MJaxTextBox($this);
	  		$this->strAgeGroup->Name = 'ageGroup';
	  		$this->strAgeGroup->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strMisc1 = new MJaxTextBox($this);
	  		$this->strMisc1->Name = 'misc1';
	  		$this->strMisc1->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strMisc2 = new MJaxTextBox($this);
	  		$this->strMisc2->Name = 'misc2';
	  		$this->strMisc2->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strMisc3 = new MJaxTextBox($this);
	  		$this->strMisc3->Name = 'misc3';
	  		$this->strMisc3->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objEnrollment)){
	     
	  	
  		
  			$this->intIdEnrollment = $this->objEnrollment->idEnrollment;
  		
  		
	     
	  	
            
	  		    $this->intIdAthelete->Text = $this->objEnrollment->idAthelete;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdCompetition->Text = $this->objEnrollment->idCompetition;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdSession->Text = $this->objEnrollment->idSession;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strFlight->Text = $this->objEnrollment->flight;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strDivision->Text = $this->objEnrollment->division;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strAgeGroup->Text = $this->objEnrollment->ageGroup;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strMisc1->Text = $this->objEnrollment->misc1;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strMisc2->Text = $this->objEnrollment->misc2;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strMisc3->Text = $this->objEnrollment->misc3;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objEnrollment->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objEnrollment)){
			//Create a new one
			$this->objEnrollment = new Enrollment();
		}

  		  
  		
		  
  		
      	$this->objEnrollment->idAthelete = $this->intIdAthelete->Text;
		
		  
  		
      	$this->objEnrollment->idCompetition = $this->intIdCompetition->Text;
		
		  
  		
      	$this->objEnrollment->idSession = $this->intIdSession->Text;
		
		  
  		
      	$this->objEnrollment->flight = $this->strFlight->Text;
		
		  
  		
      	$this->objEnrollment->division = $this->strDivision->Text;
		
		  
  		
      	$this->objEnrollment->ageGroup = $this->strAgeGroup->Text;
		
		  
  		
      	$this->objEnrollment->misc1 = $this->strMisc1->Text;
		
		  
  		
      	$this->objEnrollment->misc2 = $this->strMisc2->Text;
		
		  
  		
      	$this->objEnrollment->misc3 = $this->strMisc3->Text;
		
		
		$this->objEnrollment->Save();
  	}
  	public function btnDelete_click(){
  		$this->objEnrollment->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objEnrollment);
  	}
  	
}
?>