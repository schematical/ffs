<?php
class StripeDataEditPanelBase extends MJaxPanel{
	protected $objStripeData = null;
    
    	
    	public $intIdStripeData = null;
   		
    	
	
    	
    	
    	public $strData = null;
   		
	
    	
    	
    	public $strObject = null;
   		
	
    	
    	
    	public $intIdAuthUser = null;
   		
	
    	
    	
    	public $dttCreDate = null;
   		
	
    	
    	
    	public $intIdParentStripeData = null;
   		
	
    	
    	
    	public $strMode = null;
   		
	
    	
    	
    	public $strInstance_url = null;
   		
	
    	
    	
    	public $strStripeId = null;
   		
	
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objStripeData = null){
		parent::__construct($objParentControl);
		$this->objStripeData = $objStripeData;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/StripeDataEditPanelBase.tpl.php';
		
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
		if(is_null($this->objStripeData)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strData = new MJaxTextBox($this);
                $this->strData->Name = 'data';
                $this->strData->AddCssClass('input-large');
                //longtext
                
                    $this->strData->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->strObject = new MJaxTextBox($this);
                $this->strObject->Name = 'object';
                $this->strObject->AddCssClass('input-large');
                //longtext
                
                    $this->strObject->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->intIdAuthUser = new MJaxTextBox($this);
                $this->intIdAuthUser->Name = 'idAuthUser';
                $this->intIdAuthUser->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
	  		
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
	     
	  	
            
                $this->intIdParentStripeData = new MJaxTextBox($this);
                $this->intIdParentStripeData->Name = 'idParentStripeData';
                $this->intIdParentStripeData->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
                $this->strMode = new MJaxTextBox($this);
                $this->strMode->Name = 'mode';
                $this->strMode->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strInstance_url = new MJaxTextBox($this);
                $this->strInstance_url->Name = 'instance_url';
                $this->strInstance_url->AddCssClass('input-large');
                //varchar(256)
                
            
	  		
  		
	     
	  	
            
                $this->strStripeId = new MJaxTextBox($this);
                $this->strStripeId->Name = 'stripeId';
                $this->strStripeId->AddCssClass('input-large');
                //varchar(45)
                
            
	  		
  		
	  
	  if(!is_null($this->objStripeData)){
	     
	  	
  		
  			$this->intIdStripeData = $this->objStripeData->idStripeData;
  		
  		
	     
	  	
            
	  		    $this->strData->Text = $this->objStripeData->data;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strObject->Text = $this->objStripeData->object;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdAuthUser->Text = $this->objStripeData->idAuthUser;
            
            
  		
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                    //Do nothing this is a creDate
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdParentStripeData->Text = $this->objStripeData->idParentStripeData;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strMode->Text = $this->objStripeData->mode;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strInstance_url->Text = $this->objStripeData->instance_url;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strStripeId->Text = $this->objStripeData->stripeId;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objStripeData)){
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objStripeData)){
			//Create a new one
			$this->objStripeData = new StripeData();
		}

  		  
            
		  
            
                
                    $this->objStripeData->data = $this->strData->Text;
                
                
            
		  
            
                
                    $this->objStripeData->object = $this->strObject->Text;
                
                
            
		  
            
                
                    $this->objStripeData->idAuthUser = $this->intIdAuthUser->Text;
                
                
            
		  
            
                
                
                    //Is special field!!!!!
                    
                        //Do nothing this is a creDate
                    
                    
                
            
		  
            
                
                    $this->objStripeData->idParentStripeData = $this->intIdParentStripeData->Text;
                
                
            
		  
            
                
                    $this->objStripeData->mode = $this->strMode->Text;
                
                
            
		  
            
                
                    $this->objStripeData->instance_url = $this->strInstance_url->Text;
                
                
            
		  
            
                
                    $this->objStripeData->stripeId = $this->strStripeId->Text;
                
                
            
		
		$this->objStripeData->Save();
  	}
  	public function btnDelete_click(){
  		$this->objStripeData->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objStripeData);
  	}
  	
}
?>