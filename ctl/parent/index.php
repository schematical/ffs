<?php
//die(header('location:' . FFSForm::Competition()->Namespace . '/parent/message.php'));

class index extends FFSFeedForm
{

    protected $intLastUpdated = 0;
    public function Form_Create()
    {
        parent::Form_Create();
        if(is_null(FFSForm::Competition())){
            $this->Redirect('/index.php');
        }

        $this->InitFeed();
        krsort($this->arrFeedEntities, SORT_NUMERIC);
        if(count($this->arrFeedEntities)){
            $arrKeys = array_keys($this->arrFeedEntities);

            $this->intLastUpdated = $arrKeys[0];
        }
        $this->pxyMainWindow->AddAction(
            new MJaxTimeoutEvent(5000),
            new MJaxServerControlAction($this, 'Update')
        );


    }
    public function Update(){
        //$this->Alert("Updated :)");
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
        $strExcludeParentMessage = '';
        $pnlSelectedEntity = null;
        $intIdParentMessage = MLCApplication::QS(FFSQS::IdParentMessage);

        if(!is_null($intIdParentMessage)){
            $objParentMessage = ParentMessage::LoadById($intIdParentMessage);
            if(!is_null($objParentMessage)){
                $pnlSelectedEntity = $this->AddFeedEntity(
                    $objParentMessage,
                    'QueDate'
                );

            }
            $strExcludeParentMessage = 'AND ParentMessage.idParentMessage != ' . $intIdParentMessage . ' ';
        }
        $intIdResult= MLCApplication::QS(FFSQS::IdResult);

        if(!is_null($intIdResult)){
            $objResult = Result::LoadById($intIdResult);
            if(!is_null($objResult)){
                $pnlSelectedEntity = $this->AddFeedEntity(
                    $objResult
                );

            }


        }
        if(!is_null($pnlSelectedEntity)){
            //Makr highlighted
            $pnlSelectedEntity->AddCssClass('alert');
            $this->ScrollTo($pnlSelectedEntity);
        }
        //if user is not logged in load by competition
        //if(is_null(MLCAuthDriver::User())){


            //Load All results by session
            $arrSessions = FFSApplication::GetActiveSessions();
            foreach($arrSessions as $objSession){

                $arrResults = FFSApplication::GetResultsBySessionGroupByAthelete($objSession);
                foreach($arrResults as $arrGroupedResults){
                    foreach($arrGroupedResults as $strKey => $objResult){
                        if(is_null($objResult->IdAthelete)){
                           unset($arrGroupedResults[$strKey]);
                        }

                    }
                }
                $this->AddFeedEntity(
                    $arrResults
                );
            }
            //Load All parent messages by competiton
            $collCompetition = ParentMessage::Query(
                sprintf(
                    ' WHERE ParentMessage.idCompetition = %s AND QueDate > "%s" %s ORDER BY queDate DESC LIMIT 5',
                    FFSForm::Competition()->IdCompetition,
                    date(MLCDateTime::MYSQL_FORMAT, $this->intLastUpdated),
                    $strExcludeParentMessage
                )
            );


            $this->AddFeedEntity(
                $collCompetition,
                'QueDate'
            );
        //}else{
            //If user is logged in get their subscriptions(should be stored in rolls)

        //}

    }

}

index::Run('index');
?>