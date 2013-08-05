<?php
abstract class FFSApplication{
    public function CreateParentMessageTokens($intCt){
        $arrParentMessage = array();
        for($i = 0; $i < $intCt; $i++){
            $objParentMessage = new ParentMessage();
            $objParentMessage->CreDate = MLCDateTime::Now();
            $objParentMessage->IdUser = MLCAuthDriver::IdUser();
            $objParentMessage->Save();
            $arrParentMessage[] = $objParentMessage;
        }
        return $arrParentMessage;
    }
}