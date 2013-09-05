<?php
/**
* Class and Function List:
* Function list:
* - GetExtension()
* - Run()
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
        FFSApplication::Init();
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
        $objSearchDriver = new FFSJsonSearchDriver();
        switch ($strExtension) {
            case ('Assignment'):
            case ('assignment'):
                $objSearchDriver->_searchAssignment($strSearch, $strField);
            break;
            case ('Athelete'):
            case ('athelete'):
                $objSearchDriver->_searchAthelete($strSearch, $strField);
            break;
            case ('Competition'):
            case ('competition'):
                $objSearchDriver->_searchCompetition($strSearch, $strField);
            break;
            case ('Device'):
            case ('device'):
                $objSearchDriver->_searchDevice($strSearch, $strField);
            break;
            case ('Enrollment'):
            case ('enrollment'):
                $objSearchDriver->_searchEnrollment($strSearch, $strField);
            break;
            case ('Org'):
            case ('org'):
                $objSearchDriver->_searchOrg($strSearch, $strField);
            break;
            case ('OrgCompetition'):
            case ('orgcompetition'):
                $objSearchDriver->_searchOrgCompetition($strSearch, $strField);
            break;
            case ('ParentMessage'):
            case ('parentmessage'):
                $objSearchDriver->_searchParentMessage($strSearch, $strField);
            break;
            case ('Result'):
            case ('result'):
                $objSearchDriver->_searchResult($strSearch, $strField);
            break;
            case ('Session'):
            case ('session'):
                $objSearchDriver->_searchSession($strSearch, $strField);
            break;
            default:
                die(json_encode(array(
                    'error' => 'Not a valid searchable entity: ' . $strExtension
                )));
        }
    }
}
FFSJsonSearchDriverHandeler::Run();
