<?php
//die(header('location:' . FFSForm::Competition()->Namespace . '/parent/message.php'));

class index extends FFSFeedForm
{


    public function Form_Create()
    {
        parent::Form_Create();
        if(is_null(FFSForm::Competition())){
            $this->Redirect('/index.php');
        }

        $this->InitFeed();
        ksort($this->arrFeedEntities);


    }
    public function GetFeedEntityCtl($objFeedEntity, $mixOrigData = null){
        switch(get_class($objFeedEntity)){
            case('ParentMessage'):
                $pnlReturn = new FFSParentMessageFeedDisplayPanel($this, $objFeedEntity);
            break;
            case('Result'):
                if(count($mixOrigData) > 0){
                    $mixOrigData = FFSApplication::SortChronologically($mixOrigData);
                    $objFeedEntity = $mixOrigData[0];
                }

                $pnlReturn =  new FFSResultFeedDisplayPanel($this, $objFeedEntity);
                $pnlReturn->ExtraData = $mixOrigData;
            break;
            default:
                throw new Exception('No control defined for ' . get_class($objFeedEntity));
        }
        return $pnlReturn;
    }
    public function InitFeed(){
        $intIdParentMessage = MLCApplication::QS(FFSQS::IdParentMessage);

        if(!is_null($intIdParentMessage)){
            $this->AddFeedEntity(
                ParentMessage::LoadById($intIdParentMessage)
            );
            return ;
        }
        $intIdResult= MLCApplication::QS(FFSQS::IdResult);

        if(!is_null($intIdResult)){
            $this->AddFeedEntity(
                Result::LoadById($intIdResult)
            );
            return ;
        }
        //if user is not logged in load by competition
        //if(is_null(MLCAuthDriver::User())){

            //Load All results by session
            $arrSessions = FFSApplication::GetActiveSessions();
            foreach($arrSessions as $objSession){
                $this->AddFeedEntity(
                    FFSApplication::GetResultsBySessionGroupByAthelete($objSession)
                );
            }
            //Load All parent messages by competiton
            $this->AddFeedEntity(
                ParentMessage::LoadCollByIdCompetition(FFSForm::Competition()->IdCompetition)
            );
        //}else{
            //If user is logged in get their subscriptions(should be stored in rolls)

        //}

    }

}

index::Run('index');
?>