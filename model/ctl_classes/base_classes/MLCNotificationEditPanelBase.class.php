<?php
class MLCNotificationEditPanelBase extends MJaxPanel{
	protected $objMLCNotification = null;
    
    	
    	public $intIdNotification = null;
   		
    	
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $strClassName = null;
   		
	
    	
    	
    	public $strData = null;
   		
	
    	
    	
    	public $intViewed = null;
   		
	
	
   		//public $lnkViewParentMLCNotification = null;
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objMLCNotification = null){
		parent::__construct($objParentControl);
		$this->objMLCNotification = $objMLCNotification;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/MLCNotificationEditPanelBase.tpl.php';
		
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
		if(is_null($this->objMLCNotification)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
                $this->strClassName = new MJaxTextBox($this);
                $this->strClassName->Name = 'className';
                $this->strClassName->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strData = new MJaxTextBox($this);
                $this->strData->Name = 'data';
                $this->strData->AddCssClass('input-large');
                //longtext
                
                    $this->strData->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->intViewed = new MJaxTextBox($this);
                $this->intViewed->Name = 'viewed';
                $this->intViewed->AddCssClass('input-large');
                //int(1)
                
            
	  		
  		
	  
	  if(!is_null($this->objMLCNotification)){
	     
	  	
  		
  			$this->intIdNotification = $this->objMLCNotification->idNotification;
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->strClassName->Text = $this->objMLCNotification->className;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strData->Text = $this->objMLCNotification->data;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intViewed->Text = $this->objMLCNotification->viewed;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objMLCNotification)){
          
            if(!is_null($this->objMLCNotification->idUser)){
                $this->lnkViewParentMLCNotification = new MJaxLinkButton($this);
                $this->lnkViewParentMLCNotification->Text = 'View AuthUser';
                $this->lnkViewParentMLCNotification->Href = __ENTITY_MODEL_DIR__ . '/AuthUser/' . $this->objMLCNotification->idUser;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objMLCNotification)){
			//Create a new one
			$this->objMLCNotification = new MLCNotification();
		}

  		  
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objMLCNotification->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                    $this->objMLCNotification->className = $this->strClassName->Text;
                
                
            
		  
            
                
                    $this->objMLCNotification->data = $this->strData->Text;
                
                
            
		  
            
                
                    $this->objMLCNotification->viewed = $this->intViewed->Text;
                
                
            
		
		$this->objMLCNotification->Save();
  	}
  	public function btnDelete_click(){
  		$this->objMLCNotification->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objMLCNotification);
  	}
  	
}
?>