<?php
abstract class FFSFeedForm extends FFSForm{
    public $arrFeedEntities = array();
    public abstract function InitFeed();
    public abstract function GetFeedEntityCtl($objFeedEntity);
    public function AddFeedEntity($mixFeedEntity, $strDateField = 'CreDate', $mixOrigData = null){

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_FFSFeedForm.tpl.php';
        if(is_object($mixFeedEntity) && ($mixFeedEntity instanceof BaseEntityCollection)){
            $mixFeedEntity = $mixFeedEntity->getCollection();
        }

        if(is_array($mixFeedEntity)){
            if(is_null($mixOrigData)){
                foreach($mixFeedEntity as $intIndex => $objFeedEntity){
                    $this->AddFeedEntity($objFeedEntity, $strDateField, $mixFeedEntity);
                }
                return;
            }else{
                $mixOrigData = $mixFeedEntity;
                $mixFeedEntity = array_values($mixFeedEntity)[0];

                if(is_array($mixFeedEntity)){

                   throw new Exception("?");
                }
            }
        }

        try{
            $intTime = strtotime($mixFeedEntity->$strDateField);
        }catch(Exception $e){
            throw $e;
            throw new Exception("Objects passed in to this method must have a '" . $strDateField . "'");
        }
        while(array_key_exists($intTime, $this->arrFeedEntities)){
            $intTime += 1;
        }
        $this->arrFeedEntities[$intTime] = $this->GetFeedEntityCtl($mixFeedEntity, $mixOrigData);

    }
    public function Pre_Render(){
        ksort($this->arrFeedEntities);
        foreach($this->arrFeedEntities as $pnlFeedEntite){
            $this->AddWidget('x','x', $pnlFeedEntite);
        }
    }
}