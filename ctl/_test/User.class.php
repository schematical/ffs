<?php
class User{
    const SELECT_EXT = "wp_users.user_email as 'email',
        wp_users.display_name as 'display_name',
        wp_users.user_registered as 'user_registered',
        wp_users.ID as 'user_id'

    ";
    public static $arrUsers = array();

    public $intIdUser = null;
    public $arrDiscussions = array();
    public $arrData = array();
    public static function ParseUser($arrData){
        if(!array_key_exists($arrData['email'], self::$arrUsers)){
            self::$arrUsers[$arrData['email']] = new User();
            self::$arrUsers[$arrData['email']]->materilize($arrData);
        }
    }
    public static function Query($strExtra, $blnReturnSingle = false) {
        $link = mysql_connect('localhost', 'root', 'learnlearn');
        mysql_select_db('andregagnon');
        $sql = sprintf("SELECT * FROM wp_users %s;", $strExtra);

        $result =  mysql_query($sql);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {

            $tObj = new Cat();
            $tObj->materilize($data);
            $arrReturn[] = $tObj;
        }

        if ($blnReturnSingle) {
            if (count($arrReturn) == 0) {
                return null;
            } else {
                return $arrReturn[0];
            }
        } else {
            return $arrReturn;
        }
    }
    public function materilize($arrData){
        $this->intIdUser = $arrData['user_id'];
        $this->arrData["name"] = $arrData['display_name'];//: "engineer rich networks",
        $this->arrData["title"] = 'Customer';//: "engineer rich networks",
        $this->arrData["email"] = $arrData['email'];//: "engineer rich networks",
        $this->arrData["created_at"] = $arrData['user_registered'];//: "engineer rich networks",
        $this->arrData["state"] = 'user';
        $this->arrData["password"] = 'secret';//"author_email": "towski@entp.com",
    }

    public function GetData(){
        $arrJson = $this->arrData;
        /*foreach($this->arrDiscussions as $objDiscussion){
            $arrJson['discussions'] = $objDiscussion->GetData();
        }*/
        return $arrJson;
    }

}