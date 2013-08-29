<?php
class Cat{
    public $intIdCat = null;
    public $arrDiscussions = array();
    public $arrData = array();
    public static function Query($strExtra, $blnReturnSingle = false) {
        $link = mysql_connect('localhost', 'root', 'learnlearn');
        mysql_select_db('andregagnon');
        $sql = sprintf("SELECT * FROM wp_ahq_forum_categories %s;", $strExtra);

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
        $this->intIdCat = $arrData['id'];
        $this->arrData["name"] = $arrData['name'];//: "engineer rich networks",
        $this->arrData["summary"] = $arrData['description'];//"author_email": "towski@entp.com",

    }
    public function PopulateDiscussions(){
        $this->arrDiscussions = Discussion::Query(
            'WHERE t_category_id = ' .$this->intIdCat . ''
        );
    }
    public function GetData(){
        $arrJson = $this->arrData;
        /*foreach($this->arrDiscussions as $objDiscussion){
            $arrJson['discussions'] = $objDiscussion->GetData();
        }*/
        return $arrJson;
    }
    /*
     FileName Example: categories/1.json:

        {
            "name": "Questions and Discussions",
            "summary": ""
        }
     */
}