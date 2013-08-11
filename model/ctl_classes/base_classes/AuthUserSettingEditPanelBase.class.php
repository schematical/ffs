<?php
class AuthUserSettingEditPanelBase extends MJaxPanel{
	protected $objAuthUserSetting = null;
    
    	
    	public $intIdUserSetting = null;
   		
    	
	
    	
    	
    	public $intIdUser = null;
   		
	
    	
    	
    	public $intIdUserSettingTypeCd = null;
   		
	
    	
    	
    	public $strData = null;
   		
	
    	
    	
    	public $strNamespace = null;
   		
	
	
   		//public $lnkViewParentAuthUserSetting = null;
	
   		//public $lnkViewParentAuthUserSetting = null;
	
	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthUserSetting = null){
		parent::__construct($objParentControl);
		$this->objAuthUserSetting = $objAuthUserSetting;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthUserSettingEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAuthUserSetting)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
	  		
                //Is special field!!!!!
                
                
            
  		
	     
	  	
            
	  		
  		
	     
	  	
            
                $this->strData = new MJaxTextBox($this);
                $this->strData->Name = 'data';
                $this->strData->AddCssClass('input-large');
                //longtext
                
                    $this->strData->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->strNamespace = new MJaxTextBox($this);
                $this->strNamespace->Name = 'namespace';
                $this->strNamespace->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthUserSetting)){
	     
	  	
  		
  			$this->intIdUserSetting = $this->objAuthUserSetting->idUserSetting;
  		
  		
	     
	  	
            
            
                //Is special field!!!!!
                
                
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdUserSettingTypeCd->Text = $this->objAuthUserSetting->idUserSettingTypeCd;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strData->Text = $this->objAuthUserSetting->data;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strNamespace->Text = $this->objAuthUserSetting->namespace;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthUserSetting)){
          
            if(!is_null($this->objAuthUserSetting->idUser)){
                $this->lnkViewParentAuthUserSetting = new MJaxLinkButton($this);
                $this->lnkViewParentAuthUserSetting->Text = 'View AuthUser';
                $this->lnkViewParentAuthUserSetting->Href = __ENTITY_MODEL_DIR__ . '/AuthUser/' . $this->objAuthUserSetting->idUser;
            }
          
            if(!is_null($this->objAuthUserSetting->idUserSettingTypeCd)){
                $this->lnkViewParentAuthUserSetting = new MJaxLinkButton($this);
                $this->lnkViewParentAuthUserSetting->Text = 'View AuthUserSettingTypeCd_tpcd';
                $this->lnkViewParentAuthUserSetting->Href = __ENTITY_MODEL_DIR__ . '/AuthUserSettingTypeCd_tpcd/' . $this->objAuthUserSetting->idUserSettingTypeCd;
            }
          

	   }

           
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthUserSetting)){
			//Create a new one
			$this->objAuthUserSetting = new AuthUserSetting();
		}

  		  
            
		  
            
                
                
                    //Is special field!!!!!
                    
                    
                        $this->objAuthUserSetting->idUser = MLCAuthDriver::IdUser();
                    
                
            
		  
            
                
                
            
		  
            
                
                    $this->objAuthUserSetting->data = $this->strData->Text;
                
                
            
		  
            
                
                    $this->objAuthUserSetting->namespace = $this->strNamespace->Text;
                
                
            
		
		$this->objAuthUserSetting->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthUserSetting->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthUserSetting);
  	}
  	
}
?>