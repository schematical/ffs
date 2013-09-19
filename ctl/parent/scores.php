<?php
class scores extends FFSParentCoachMobileScoreForm{
    public function QueryAtheletes(){
        $arrAtheletes = FFSApplication::GetAtheletesByParent();
        return $arrAtheletes;
    }
}
scores::Run('scores'); ?>