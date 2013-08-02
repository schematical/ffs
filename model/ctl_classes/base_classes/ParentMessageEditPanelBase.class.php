<?php
class ParentMessageEditPanelBase extends MJaxPanel{
	protected $objParentMessage = null;
    
    	
    	public $intIdParentMessage = null;
   		
    	
	
    	
    	
    	public $intIdAthelete = null;
   		
	
    	
    	
    	public $strAtheleteName = null;
   		
	
    	
    	
    	public $strMessage = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $dttDispDate = null;
   		
	
    	
    	
    	public $intIdUser = null;
   		
	
	
   		public $lnkViewParentParentMessage = null;
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objParentMessage = null){
		parent::__construct($objParentControl);
		$this->objParentMessage = $objParentMessage;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/ParentMessageEditPanelBase.tpl.php';
		
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
		if(is_null($this->objParentMessage)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strAtheleteName = new MJaxTextBox($this);
                $this->strAtheleteName->Name = 'atheleteName';
                $this->strAtheleteName->AddCssClass('input-large');
                //varchar(255)
                
            
	  		
  		
	     
	  	
            
                $this->strMessage = new MJaxTextBox($this);
                $this->strMessage->Name = 'message';
                $this->strMessage->AddCssClass('input-large');
                //longtext
                
                    $this->strMessage->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
                    $this->dttDispDate = new MJaxJQueryDateSelectPanel($this);
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	  
	  if(!is_null($this->objParentMessage)){
	     
	  	
  		
  			$this->intIdParentMessage = $this->objParentMessage->idParentMessage;
  		
  		
	     
	  	
            
	  		    $this->intIdAthelete->Text = $this->objParentMessage->idAthelete;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strAtheleteName->Text = $this->objParentMessage->atheleteName;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strMessage->Text = $this->objParentMessage->message;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
                    $this->dttDispDate->Value = $this->objParentMessage->dispDate;
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objParentMessage)){
          
            if(!is_null($this->objParentMessage->idAthelete)){
                $this->lnkViewParentParentMessage = new MJaxLinkButton($this);
                $this->lnkViewParentParentMessage->Text = 'View Athelete';
                $this->lnkViewParentParentMessage->Href = __ENTITY_MODEL_DIR__ . '/Athelete/' . $this->objParentMessage->idAthelete;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objParentMessage)){
			//Create a new one
			$this->objParentMessage = new ParentMessage();
		}

  		  
            
		  
            
                
                
            
		  
            
                
                    $this->objParentMessage->atheleteName = $this->strAtheleteName->Text;
                
                
            
		  
            
                
                    $this->objParentMessage->message = $this->strMessage->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objParentMessage->idUser = MLCAuthDriver::IdUser();
                    
                
            
		
		$this->objParentMessage->Save();
  	}
  	public function btnDelete_click(){
  		$this->objParentMessage->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objParentMessage);
  	}
  	
}
?>