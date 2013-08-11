<?php
class AuthUserEditPanelBase extends MJaxPanel{
	protected $objAuthUser = null;
    
    	
    	public $intIdUser = null;
   		
    	
	
    	
    	
    	public $strEmail = null;
   		
	
    	
    	
    	public $strPassword = null;
   		
	
    	
    	
    	public $intIdAccount = null;
   		
	
    	
    	
    	public $intIdUserTypeCd = null;
   		
	
    	
    	
    	public $strUsername = null;
   		
	
    	
    	
    	public $strPassResetCode = null;
   		
	
    	
    	
    	public $strFbuid = null;
   		
	
    	
    	
    	public $strFbAccessToken = null;
   		
	
    	
    	
    	public $intActive = null;
   		
	
    	
    	
    	public $strFriendsIds = null;
   		
	
    	
    	
    	public $dttFriendsUpdated = null;
   		
	
    	
    	
    	public $intFbAccessTokenExpires = null;
   		
	
	
	
  		public $lnkViewChildMLCNotification = null;
  	
	//Regular controls
	
	public $btnSave = null;
	public $btnDelete = null;

	public function __construct($objParentControl, $objAuthUser = null){
		parent::__construct($objParentControl);
		$this->objAuthUser = $objAuthUser;
		
		$this->strTemplate = __VIEW_ACTIVE_APP_DIR__  . '/www/ctl_panels/AuthUserEditPanelBase.tpl.php';
		
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
		if(is_null($this->objAuthUser)){
			$this->btnDelete->Style->Display = 'none';

		}
	
	}
	public function CreateFieldControls(){
	     
	  	
	     
	  	
            
                $this->strEmail = new MJaxTextBox($this);
                $this->strEmail->Name = 'email';
                $this->strEmail->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->strPassword = new MJaxTextBox($this);
                $this->strPassword->Name = 'password';
                $this->strPassword->AddCssClass('input-large');
                //varchar(64)
                
            
	  		
  		
	     
	  	
            
                $this->intIdAccount = new MJaxTextBox($this);
                $this->intIdAccount->Name = 'idAccount';
                $this->intIdAccount->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
                $this->intIdUserTypeCd = new MJaxTextBox($this);
                $this->intIdUserTypeCd->Name = 'idUserTypeCd';
                $this->intIdUserTypeCd->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	     
	  	
            
                $this->strUsername = new MJaxTextBox($this);
                $this->strUsername->Name = 'username';
                $this->strUsername->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
                $this->strPassResetCode = new MJaxTextBox($this);
                $this->strPassResetCode->Name = 'passResetCode';
                $this->strPassResetCode->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
                $this->strFbuid = new MJaxTextBox($this);
                $this->strFbuid->Name = 'fbuid';
                $this->strFbuid->AddCssClass('input-large');
                //varchar(128)
                
            
	  		
  		
	     
	  	
            
                $this->strFbAccessToken = new MJaxTextBox($this);
                $this->strFbAccessToken->Name = 'fbAccessToken';
                $this->strFbAccessToken->AddCssClass('input-large');
                //varchar(256)
                
            
	  		
  		
	     
	  	
            
                $this->intActive = new MJaxTextBox($this);
                $this->intActive->Name = 'active';
                $this->intActive->AddCssClass('input-large');
                //int(1)
                
            
	  		
  		
	     
	  	
            
                $this->strFriendsIds = new MJaxTextBox($this);
                $this->strFriendsIds->Name = 'friendsIds';
                $this->strFriendsIds->AddCssClass('input-large');
                //longtext
                
                    $this->strFriendsIds->TextMode = MJaxTextMode::MultiLine;
                
            
	  		
  		
	     
	  	
            
                $this->dttFriendsUpdated = new MJaxTextBox($this);
                $this->dttFriendsUpdated->Name = 'friendsUpdated';
                $this->dttFriendsUpdated->AddCssClass('input-large');
                //datetime
                
            
	  		
  		
	     
	  	
            
                $this->intFbAccessTokenExpires = new MJaxTextBox($this);
                $this->intFbAccessTokenExpires->Name = 'fbAccessTokenExpires';
                $this->intFbAccessTokenExpires->AddCssClass('input-large');
                //int(11)
                
            
	  		
  		
	  
	  if(!is_null($this->objAuthUser)){
	     
	  	
  		
  			$this->intIdUser = $this->objAuthUser->idUser;
  		
  		
	     
	  	
            
	  		    $this->strEmail->Text = $this->objAuthUser->email;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strPassword->Text = $this->objAuthUser->password;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdAccount->Text = $this->objAuthUser->idAccount;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intIdUserTypeCd->Text = $this->objAuthUser->idUserTypeCd;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strUsername->Text = $this->objAuthUser->username;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strPassResetCode->Text = $this->objAuthUser->passResetCode;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strFbuid->Text = $this->objAuthUser->fbuid;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strFbAccessToken->Text = $this->objAuthUser->fbAccessToken;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intActive->Text = $this->objAuthUser->active;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->strFriendsIds->Text = $this->objAuthUser->friendsIds;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->dttFriendsUpdated->Text = $this->objAuthUser->friendsUpdated;
            
            
  		
  		
  		
	     
	  	
            
	  		    $this->intFbAccessTokenExpires->Text = $this->objAuthUser->fbAccessTokenExpires;
            
            
  		
  		
  		
	  
	  }
	}
	public function CreateReferenceControls(){
        if(!is_null($this->objAuthUser)){
          

	   }

           

            $this->lnkViewChildMLCNotification = new MJaxLinkButton($this);
            $this->lnkViewChildMLCNotification->Text = 'View MLCNotifications';
            //I should really fix this
            //$this->lnkViewChildMLCNotification->Href = __ENTITY_MODEL_DIR__ . '/AuthUser/' . $this->objAuthUser->idUser . '/MLCNotifications';

          
	}
	
	public function btnSave_click(){
		if(is_null($this->objAuthUser)){
			//Create a new one
			$this->objAuthUser = new AuthUser();
		}

  		  
            
		  
            
                
                    $this->objAuthUser->email = $this->strEmail->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->password = $this->strPassword->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->idAccount = $this->intIdAccount->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->idUserTypeCd = $this->intIdUserTypeCd->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->username = $this->strUsername->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->passResetCode = $this->strPassResetCode->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->fbuid = $this->strFbuid->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->fbAccessToken = $this->strFbAccessToken->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->active = $this->intActive->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->friendsIds = $this->strFriendsIds->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->friendsUpdated = $this->dttFriendsUpdated->Text;
                
                
            
		  
            
                
                    $this->objAuthUser->fbAccessTokenExpires = $this->intFbAccessTokenExpires->Text;
                
                
            
		
		$this->objAuthUser->Save();
  	}
  	public function btnDelete_click(){
  		$this->objAuthUser->Delete();
  	}
  	public function IsNew(){
  		return is_null($this->objAuthUser);
  	}
  	
}
?>