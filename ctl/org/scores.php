<?php
class scores extends FFSParentCoachMobileScoreForm{
    public function QueryAtheletes(){

        $arrAtheletes = FFSApplication::GetAtheletesByOrgManager();
        return $arrAtheletes;
    }
}
scores::Run('scores'); ?>