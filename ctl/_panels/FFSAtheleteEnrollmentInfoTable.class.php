<?php
class FFSAtheleteEnrollmentInfoTable extends MJaxTable{


    public function __construct($objParentControl, $arrEnrollments = null){
        parent::__construct($objParentControl);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->AddColumn('athelete_name', 'Name')
        foreach($arrEnrollments as $intIndex => $mixEntrollment){
            if($mixEntrollment instanceof Enrollment){
                $objEnrollment = $mixEntrollment;
                $objSession = $mixEntrollment->IdSessionObject;
                $objAthelete = $mixEntrollment->IdAtheleteObject;
            }elseif($mixEntrollment instanceof Athelete){
                throw new Exception("TODO:write this");
                /*if(is_null(FFSForm::$objCompetition)){
                    $objEnrollment
                }
                $objEnrollment = $mixEntrollment->IdAtheleteObject;
                $objAthelete = $mixEntrollment;*/

            }elseif($mixEntrollment instanceof Session){
                throw new Exception("TODO:write this");
            }else{
                throw new Exception("TODO:write this");
            }

            $arrRowData['athelete_name'] = $objAthelete->LastName. ', ' . $objAthelete->FirstName;
            //Add enrollment data

            $this->AddRow($arrRowData);
        }
       
    }
    
}