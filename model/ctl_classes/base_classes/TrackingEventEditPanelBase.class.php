<?php
class TrackingEventEditPanelBase extends MJaxPanel{
	protected $objTrackingEvent = null;
    
    	
    	public $intIdTrackingEvent = null;
   		
    	
	
    	
    	
    	public $strName = null;
   		
	
    	
    	
    	public $strValue = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $intIdSession = null;
   		
	
    	
    	
    	public $intIdApplication = null;
   		
	
    	
    	
    	public $strApp = null;
   		
	
	
   		//public $lnkViewParentTrackingEvent = null;
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objTrackingEvent = null){
		parent::__construct($objParentControl);
		$this->objTrackingEvent = $objTrackingEvent;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/TrackingEventEditPanelBase.tpl.php';
		
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
		if(is_null($this->objTrackingEvent)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strName = new MJaxTextBox($this);
                $this->strName->Name = 'name';
                $this->strName->AddCssClass('input-large');
                //varchar(32)
                
            
	  		
  		
	     
	  	
            
                $this->strValue = new MJaxTextBox($this);
                $this->strValue->Name = 'value';
                $this->strValue->AddCssClass('input-large');
                //varchar(256)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->intIdApplication = new MJaxTextBox($this);
                $this->intIdApplication->Name = 'idApplication';
                $this->intIdApplication->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
                $this->strApp = new MJaxTextBox($this);
                $this->strApp->Name = 'app';
                $this->strApp->AddCssClass('input-large');
                //varchar(32)
                
            
	  		
  		
	  
	  if(!is_null($this->objTrackingEvent)){
	     
	  	
  		
  			$this->intIdTrackingEvent = $this->objTrackingEvent->idTrackingEvent;
  		
  		
	     
	  	
            
	  		    $this->strName->Text = $this->objTrackingEvent->name;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strValue->Text = $this->objTrackingEvent->value;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdSession->Text = $this->objTrackingEvent->idSession;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdApplication->Text = $this->objTrackingEvent->idApplication;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strApp->Text = $this->objTrackingEvent->app;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objTrackingEvent)){
          
            if(!is_null($this->objTrackingEvent->idSession)){
                $this->lnkViewParentTrackingEvent = new MJaxLinkButton($this);
                $this->lnkViewParentTrackingEvent->Text = 'View AuthSession';
                $this->lnkViewParentTrackingEvent->Href = __ENTITY_MODEL_DIR__ . '/AuthSession/' . $this->objTrackingEvent->idSession;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objTrackingEvent)){
			//Create a new one
			$this->objTrackingEvent = new TrackingEvent();
		}

  		  
            
		  
            
                
                    $this->objTrackingEvent->name = $this->strName->Text;
                
                
            
		  
            
                
                    $this->objTrackingEvent->value = $this->strValue->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objTrackingEvent->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                
            
		  
            
                
                    $this->objTrackingEvent->idApplication = $this->intIdApplication->Text;
                
                
            
		  
            
                
                    $this->objTrackingEvent->app = $this->strApp->Text;
                
                
            
		
		$this->objTrackingEvent->Save();
  	}
  	public function btnDelete_click(){
  		$this->objTrackingEvent->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objTrackingEvent);
  	}
  	
}
?>