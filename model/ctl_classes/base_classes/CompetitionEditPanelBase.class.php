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
   		
	
    	
    	
    	public $strNamespace = null;
   		
	
	
   		public $lnkViewParentCompetition = null;
	
	
  		public $lnkViewChildSession = null;
  	
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
		$this->btnSave->AddCssClass('btn btn-large');
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		$this->btnDelete->AddCssClass('btn btn-large');
		if(is_null($this->objCompetition)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strName = new MJaxTextBox($this);
                $this->strName->Name = 'name';
                $this->strName->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
                $this->strLongDesc = new MJaxTextBox($this);
                $this->strLongDesc->Name = 'longDesc';
                $this->strLongDesc->AddCssClass('input-large');
                //longtext
                
                    $this->strLongDesc->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttStartDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttEndDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strNamespace = new MJaxTextBox($this);
                $this->strNamespace->Name = 'namespace';
                $this->strNamespace->AddCssClass('input-large');
                //varchar(45)
                
            
	  		
  		
	  
	  if(!is_null($this->objCompetition)){
	     
	  	
  		
  			$this->intIdCompetition = $this->objCompetition->idCompetition;
  		
  		
	     
	  	
            
	  		    $this->strName->Text = $this->objCompetition->name;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strLongDesc->Text = $this->objCompetition->longDesc;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
                    $this->dttStartDate->Value = $this->objCompetition->startDate;
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
                    $this->dttEndDate->Value = $this->objCompetition->endDate;
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdOrg->Text = $this->objCompetition->idOrg;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strNamespace->Text = $this->objCompetition->namespace;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objCompetition)){
          
            if(!is_null($this->objCompetition->idOrg)){
                $this->lnkViewParentCompetition = new MJaxLinkButton($this);
                $this->lnkViewParentCompetition->Text = 'View Org';
                $this->lnkViewParentCompetition->Href = __ENTITY_MODEL_DIR__ . '/Org/' . $this->objCompetition->idOrg;
            }
          

	   }

           

            $this->lnkViewChildSession = new MJaxLinkButton($this);
            $this->lnkViewChildSession->Text = 'View Sessions';
            //I should really fix this
            //$this->lnkViewChildSession->Href = __ENTITY_MODEL_DIR__ . '/Competition/' . $this->objCompetition->idCompetition . '/Sessions';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objCompetition)){
			//Create a new one
			$this->objCompetition = new Competition();
		}

  		  
            
		  
            
                
                    $this->objCompetition->name = $this->strName->Text;
                
                
            
		  
            
                
                    $this->objCompetition->longDesc = $this->strLongDesc->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
            
		  
            
                
                    $this->objCompetition->namespace = $this->strNamespace->Text;
                
                
            
		
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