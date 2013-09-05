<?php
/**
* Class and Function List:
* Function list:
* - GetExtension()
* - Run()
* - RenderJsonResponse()
* Classes list:
* - FFSJsonSearchDriverHandeler
*/
abstract class FFSJsonSearchDriverHandeler {
    public static function GetExtension() {
        if (array_key_exists('mjax-route-ext', $_GET)) {
            return $_GET['mjax-route-ext'];
        }
        return pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION);
    }
    public static function Run() {
        if (array_key_exists('search', $_POST)) {
            $strSearch = $_POST['search'];
        } else {
            $strSearch = '';
        }
        $arrParts = explode('_', self::GetExtension());
        $strExtension = $arrParts[0];
        if (count($arrParts) == 2) {
            $strField = $arrParts[1];
        } else {
            $strField = null;
        }
        $objSearchDriver = MLCApplication::$objRewriteHandeler->EntityManager;
        if (is_null($objSearchDriver)) {
            $objSearchDriver = new FFSEntityManager();
        }
        $objSearchDriver->Populate();
        switch ($strExtension) {
            case ('Assignment'):
            case ('assignment'):
                $arrEntities = $objSearchDriver->SearchAssignment($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Athelete'):
            case ('athelete'):
                $arrEntities = $objSearchDriver->SearchAthelete($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Competition'):
            case ('competition'):
                $arrEntities = $objSearchDriver->SearchCompetition($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Device'):
            case ('device'):
                $arrEntities = $objSearchDriver->SearchDevice($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Enrollment'):
            case ('enrollment'):
                $arrEntities = $objSearchDriver->SearchEnrollment($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Org'):
            case ('org'):
                $arrEntities = $objSearchDriver->SearchOrg($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('OrgCompetition'):
            case ('orgcompetition'):
                $arrEntities = $objSearchDriver->SearchOrgCompetition($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('ParentMessage'):
            case ('parentmessage'):
                $arrEntities = $objSearchDriver->SearchParentMessage($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Result'):
            case ('result'):
                $arrEntities = $objSearchDriver->SearchResult($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            case ('Session'):
            case ('session'):
                $arrEntities = $objSearchDriver->SearchSession($strSearch, $strField);
                self::RenderJsonResponse($arrEntities, $strField);
            break;
            default:
                die(json_encode(array(
                    'error' => 'Not a valid searchable entity: ' . $strExtension
                )));
        }
    }
    public static function RenderJsonResponse($arrEntities, $strField = null) {
        $arrData = array();
        foreach ($arrEntities as $objEntity) {
            if (is_null($strField)) {
                $strText = $objEntity->__toString();
            } else {
                $strText = $objEntity->__get($strField);
            }
            $arrData[] = array(
                'text' => $strText,
                'value' => get_class($objEntity) . '_' . $objEntity->GetId()
            );
        }
        die(json_encode($arrData));
    }
}
FFSJsonSearchDriverHandeler::Run();
