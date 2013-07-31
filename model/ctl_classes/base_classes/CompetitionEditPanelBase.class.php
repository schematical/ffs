<?php
class CompetitionEditPanelBase extends MJaxPanel{
	protected $objCompetition = null;
    
    	
    	public $intIdCompetition = null;
   		
    	
	
    	
    	
    	public $strName = null;
   		
	
    	
    	
    	public $strLongDesc = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $dttStartDate = null;
   		
	
    	
    	
    	public $dttEndDate = null;
   		
	
    	
    	
    	public $intIdOrg = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objCompetition = null){
		parent::__construct($objParentControl);
		$this->objCompetition = $objCompetition;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/CompetitionEditPanelBase.tpl.php';
		
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
		if(is_null($this->objCompetition)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->strName = new MJaxTextBox($this);
	  		$this->strName->Name = 'name';
	  		$this->strName->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strLongDesc = new MJaxTextBox($this);
	  		$this->strLongDesc->Name = 'longDesc';
	  		$this->strLongDesc->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttCreDate = new MJaxTextBox($this);
	  		$this->dttCreDate->Name = 'creDate';
	  		$this->dttCreDate->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttStartDate = new MJaxTextBox($this);
	  		$this->dttStartDate->Name = 'startDate';
	  		$this->dttStartDate->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttEndDate = new MJaxTextBox($this);
	  		$this->dttEndDate->Name = 'endDate';
	  		$this->dttEndDate->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdOrg = new MJaxTextBox($this);
	  		$this->intIdOrg->Name = 'idOrg';
	  		$this->intIdOrg->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objCompetition)){
	     
	  	
  		
  			$this->intIdCompetition = $this->objCompetition->idCompetition;
  		
  		
	     
	  	
            
	  		    $this->strName->Text = $this->objCompetition->name;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strLongDesc->Text = $this->objCompetition->longDesc;
            
            
  		
  		
  		
	     
	  	
            
            
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->dttStartDate->Text = $this->objCompetition->startDate;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->dttEndDate->Text = $this->objCompetition->endDate;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdOrg->Text = $this->objCompetition->idOrg;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objCompetition->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objCompetition)){
			//Create a new one
			$this->objCompetition = new Competition();
		}

  		  
  		
		  
  		
      	$this->objCompetition->name = $this->strName->Text;
		
		  
  		
      	$this->objCompetition->longDesc = $this->strLongDesc->Text;
		
		  
  		
      	$this->objCompetition->creDate = $this->dttCreDate->Text;
		
		  
  		
      	$this->objCompetition->startDate = $this->dttStartDate->Text;
		
		  
  		
      	$this->objCompetition->endDate = $this->dttEndDate->Text;
		
		  
  		
      	$this->objCompetition->idOrg = $this->intIdOrg->Text;
		
		
		$this->objCompetition->Save();
  	}
  	public function btnDelete_click(){
  		$this->objCompetition->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objCompetition);
  	}
  	
}
?>