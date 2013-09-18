<?php
abstract class FFSFeedDisplayPanel extends MJaxFeedDisplayPanelBase{


    public function __construct($objParentControl, $objEntity = null){
        parent::__construct($objParentControl, $objEntity);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        if($this->objEntity instanceof MLCBaseEntityCollection){
            $this->SetFollowEntity($this->objEntity->Athelete);
        }else{
            if(!is_null($this->objEntity->IdAtheleteObject)){
                $this->SetFollowEntity($this->objEntity->IdAtheleteObject);
            }
        }

        if(
            (!is_null($this->objFollowEntity)) &&
            (!is_null(FFSForm::Competition()))
        ){
            $this->lnkMessage = new MJaxLinkButton($this);
            $this->lnkMessage->Text = 'Shout out';
            $this->lnkMessage->AddCssClass('btn btn-small');
            //$this->lnkMessage->Url = $this->GetShareUrl();
            $this->lnkMessage->AddAction(
                $this,
                'lnkMessage_click'
            );

        }
    }
    public function lnkMessage_click(){
        $this->objForm->Redirect(
            sprintf(
                '%s/parent/message',
                FFSForm::Competition()->Namespace
            ),
            array(
                FFSQS::IdAthelete => $this->objFollowEntity->IdAthelete
            )
        );
    }
}