<?php
class AuthUserSettingTypeCd_tpcdEditPanelBase extends MJaxPanel{
	protected $objAuthUserSettingTypeCd_tpcd = null;
    
    	
    	public $intIdUserSettingType = null;
   		
    	
	
    	
    	
    	public $strShortDesc = null;
   		
	
	
	
  		public $lnkViewChildAuthUserSetting = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthUserSettingTypeCd_tpcd = null){
		parent::__construct($objParentControl);
		$this->objAuthUserSettingTypeCd_tpcd = $objAuthUserSettingTypeCd_tpcd;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthUserSettingTypeCd_tpcdEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAuthUserSettingTypeCd_tpcd)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strShortDesc = new MJaxTextBox($this);
                $this->strShortDesc->Name = 'shortDesc';
                $this->strShortDesc->AddCssClass('input-large');
                //varchar(16)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthUserSettingTypeCd_tpcd)){
	     
	  	
  		
  			$this->intIdUserSettingType = $this->objAuthUserSettingTypeCd_tpcd->idUserSettingType;
  		
  		
	     
	  	
            
	  		    $this->strShortDesc->Text = $this->objAuthUserSettingTypeCd_tpcd->shortDesc;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthUserSettingTypeCd_tpcd)){
          

	   }

           

            $this->lnkViewChildAuthUserSetting = new MJaxLinkButton($this);
            $this->lnkViewChildAuthUserSetting->Text = 'View AuthUserSettings';
            //I should really fix this
            //$this->lnkViewChildAuthUserSetting->Href = __ENTITY_MODEL_DIR__ . '/AuthUserSettingTypeCd_tpcd/' . $this->objAuthUserSettingTypeCd_tpcd->idUserSettingTypeCd . '/AuthUserSettings';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthUserSettingTypeCd_tpcd)){
			//Create a new one
			$this->objAuthUserSettingTypeCd_tpcd = new AuthUserSettingTypeCd_tpcd();
		}

  		  
            
		  
            
                
                    $this->objAuthUserSettingTypeCd_tpcd->shortDesc = $this->strShortDesc->Text;
                
                
            
		
		$this->objAuthUserSettingTypeCd_tpcd->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthUserSettingTypeCd_tpcd->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthUserSettingTypeCd_tpcd);
  	}
  	
}
?>