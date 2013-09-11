<?php
abstract class FFSFeedForm extends FFSForm{
    public $arrFeedEntities = array();
    public abstract function InitFeed();
    public abstract function GetFeedEntityCtl($objFeedEntity);
    public function Form_Create(){
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_FFSFeedForm.tpl.php';
    }
    public function AddFeedEntity($mixFeedEntity, $strDateField = 'CreDate', $mixOrigData = null){
        if(is_null($mixFeedEntity)){
            return null;
        }
        //$this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_FFSFeedForm.tpl.php';
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

        if(is_numeric($intTime)){
            while(array_key_exists($intTime, $this->arrFeedEntities)){
                $intTime += 1;
            }
            $this->arrFeedEntities[$intTime] = $this->GetFeedEntityCtl($mixFeedEntity, $mixOrigData);
        }else{
            //_dv($mixFeedEntity);
            throw new Exception("Invalid time to sort by");
        }
        return $this->arrFeedEntities[$intTime];

    }
    public function Pre_Render(){
        _dv(array_keys($this->arrFeedEntities));
        krsort($this->arrFeedEntities, SORT_NUMERIC);
        foreach($this->arrFeedEntities as $pnlFeedEntite){
            $this->AddWidget('x','x', $pnlFeedEntite);
        }
    }
}