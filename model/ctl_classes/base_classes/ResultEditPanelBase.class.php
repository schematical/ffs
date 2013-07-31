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
		
		
		$this->btnDelete = new MJaxButton($this);
		$this->btnDelete->Text = 'Delete';
		$this->btnDelete->AddAction(new MJaxClickEvent(), new MJaxServerControlAction($this, 'btnDelete_click'));
		if(is_null($this->objResult)){
			$this->btnDelete->Style->Display = 'none';
		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
	  		$this->intIdSession = new MJaxTextBox($this);
	  		$this->intIdSession->Name = 'idSession';
	  		$this->intIdSession->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intIdAthelete = new MJaxTextBox($this);
	  		$this->intIdAthelete->Name = 'idAthelete';
	  		$this->intIdAthelete->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strScore = new MJaxTextBox($this);
	  		$this->strScore->Name = 'score';
	  		$this->strScore->AddCssClass('input-large');
  		
	     
	  	
	  		$this->strJudge = new MJaxTextBox($this);
	  		$this->strJudge->Name = 'judge';
	  		$this->strJudge->AddCssClass('input-large');
  		
	     
	  	
	  		$this->intFlag = new MJaxTextBox($this);
	  		$this->intFlag->Name = 'flag';
	  		$this->intFlag->AddCssClass('input-large');
  		
	     
	  	
	  		$this->dttCreDate = new MJaxTextBox($this);
	  		$this->dttCreDate->Name = 'creDate';
	  		$this->dttCreDate->AddCssClass('input-large');
  		
	  
	  if(!is_null($this->objResult)){
	     
	  	
  		
  			$this->intIdResult = $this->objResult->idResult;
  		
  		
	     
	  	
            
	  		    $this->intIdSession->Text = $this->objResult->idSession;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdAthelete->Text = $this->objResult->idAthelete;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strScore->Text = $this->objResult->score;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strJudge->Text = $this->objResult->judge;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intFlag->Text = $this->objResult->flag;
            
            
  		
  		
  		
	     
	  	
            
            
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
	  
	 // if(!is_null($this->objResult->i)){
	   
	 // }
	}
	
	public function btnSave_click(){
		if(is_null($this->objResult)){
			//Create a new one
			$this->objResult = new Result();
		}

  		  
  		
		  
  		
      	$this->objResult->idSession = $this->intIdSession->Text;
		
		  
  		
      	$this->objResult->idAthelete = $this->intIdAthelete->Text;
		
		  
  		
      	$this->objResult->score = $this->strScore->Text;
		
		  
  		
      	$this->objResult->judge = $this->strJudge->Text;
		
		  
  		
      	$this->objResult->flag = $this->intFlag->Text;
		
		  
  		
      	$this->objResult->creDate = $this->dttCreDate->Text;
		
		
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