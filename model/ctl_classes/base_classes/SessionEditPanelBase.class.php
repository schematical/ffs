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
   		
	
    	
    	
    	public $strEquipmentSet = null;
   		
	
    	
    	
    	public $strEventData = null;
   		
	
	
   		public $lnkViewParentIdCompetition = null;
	
	
  		public $lnkViewChildResult = null;
  	
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
		$this->btnSave->AddCssClass('btn btn-large');
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		$this->btnDelete->AddCssClass('btn btn-large');
		if(is_null($this->objSession)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttStartDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttEndDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strName = new MJaxTextBox($this);
                $this->strName->Name = 'name';
                $this->strName->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strNotes = new MJaxTextBox($this);
                $this->strNotes->Name = 'notes';
                $this->strNotes->AddCssClass('input-large');
                //longtext
                
                    $this->strNotes->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->strData = new MJaxTextBox($this);
                $this->strData->Name = 'data';
                $this->strData->AddCssClass('input-large');
                //longtext
                
                    $this->strData->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->strEquipmentSet = new MJaxTextBox($this);
                $this->strEquipmentSet->Name = 'equipmentSet';
                $this->strEquipmentSet->AddCssClass('input-large');
                //varchar(45)
                
            
	  		
  		
	     
	  	
            
                $this->strEventData = new MJaxTextBox($this);
                $this->strEventData->Name = 'eventData';
                $this->strEventData->AddCssClass('input-large');
                //longtext
                
                    $this->strEventData->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	  
	  if(!is_null($this->objSession)){
            $this->SetSession($this->objSession);
	  }
  }
  public function SetSession($objSession){
      $this->objSession = $objSession;
      $this->blnModified = true;
      if(!is_null($this->objSession)){
          
            
            
                //PKey
                $this->intIdSession = $this->objSession->idSession;
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttStartDate->Value = $this->objSession->startDate;
                    
                
            
            

          
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->dttEndDate->Value = $this->objSession->endDate;
                    
                
            
            

          
            
                
                
            
            

          
            
                
                    $this->strName->Text = $this->objSession->name;
                
                
            
            

          
            
                
                    $this->strNotes->Text = $this->objSession->notes;
                
                
            
            

          
            
                
                    $this->strData->Text = $this->objSession->data;
                
                
            
            

          
            
                
                    $this->strEquipmentSet->Text = $this->objSession->equipmentSet;
                
                
            
            

          
            
                
                    $this->strEventData->Text = $this->objSession->eventData;
                
                
            
            

          
      }

	}
	public function CreateReferenceControls(){
        if(!is_null($this->objSession)){
          
            if(!is_null($this->objSession->idCompetition)){
                $this->lnkViewParentIdCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentIdCompetition->Text = 'View Competition';
                $this->lnkViewParentIdCompetition->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objSession->idCompetition;
            }
          

	   }

           

            $this->lnkViewChildResult = new MJaxLinkButton($this);
            $this->lnkViewChildResult->Text = 'View Results';
            //I should really fix this
            //$this->lnkViewChildResult->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objSession->idSession . '/Results';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objSession)){
			//Create a new one
			$this->objSession = new Session();
		}

  		  
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
            
		  
            
                
                    $this->objSession->name = $this->strName->Text;
                
                
            
		  
            
                
                    $this->objSession->notes = $this->strNotes->Text;
                
                
            
		  
            
                
                    $this->objSession->data = $this->strData->Text;
                
                
            
		  
            
                
                    $this->objSession->equipmentSet = $this->strEquipmentSet->Text;
                
                
            
		  
            
                
                    $this->objSession->eventData = $this->strEventData->Text;
                
                
            
		
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