<?php
class ResultEditPanelBase extends MJaxPanel{
	protected $objResult = null;
    
    	
    	public $intIdResult = null;
   		
    	
	
    	
    	
    	public $intIdSession = null;
   		
	
    	
    	
    	public $intIdAthelete = null;
   		
	
    	
    	
    	public $strScore = null;
   		
	
    	
    	
    	public $strJudge = null;
   		
	
    	
    	
    	public $intFlag = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
	
   		public $lnkViewParentResult = null;
	
   		public $lnkViewParentResult = null;
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objResult = null){
		parent::__construct($objParentControl);
		$this->objResult = $objResult;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/ResultEditPanelBase.tpl.php';
		
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
		if(is_null($this->objResult)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
  		
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strScore = new MJaxTextBox($this);
                $this->strScore->Name = 'score';
                $this->strScore->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strJudge = new MJaxTextBox($this);
                $this->strJudge->Name = 'judge';
                $this->strJudge->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->intFlag = new MJaxTextBox($this);
                $this->intFlag->Name = 'flag';
                $this->intFlag->AddCssClass('input-large');
                //tinyint(4)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	  
	  if(!is_null($this->objResult)){
	     
	  	
  		
  			$this->intIdResult = $this->objResult->idResult;
  		
  		
	     
	  	
            
	  		    $this->intIdSession->Text = $this->objResult->idSession;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdAthelete->Text = $this->objResult->idAthelete;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strScore->Text = $this->objResult->score;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strJudge->Text = $this->objResult->judge;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intFlag->Text = $this->objResult->flag;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objResult)){
          
            if(!is_null($this->objResult->idSession)){
                $this->lnkViewParentResult = new MJaxLinkButton($this);
                $this->lnkViewParentResult->Text = 'View Session';
                $this->lnkViewParentResult->Href = __ENTITY_MODEL_DIR__ . '/Session/' . $this->objResult->idSession;
            }
          
            if(!is_null($this->objResult->idAthelete)){
                $this->lnkViewParentResult = new MJaxLinkButton($this);
                $this->lnkViewParentResult->Text = 'View Athelete';
                $this->lnkViewParentResult->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objResult->idAthelete;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objResult)){
			//Create a new one
			$this->objResult = new Result();
		}

  		  
            
		  
            
                
                
            
		  
            
                
                
            
		  
            
                
                    $this->objResult->score = $this->strScore->Text;
                
                
            
		  
            
                
                    $this->objResult->judge = $this->strJudge->Text;
                
                
            
		  
            
                
                    $this->objResult->flag = $this->intFlag->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		
		$this->objResult->Save();
  	}
  	public function btnDelete_click(){
  		$this->objResult->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objResult);
  	}
  	
}
?>