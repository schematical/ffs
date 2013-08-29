<?php

class Discussion{
    public $intIdTopic = null;
    public $arrComments = array();
    public $arrData = array();
    public static function Query($strExtra, $blnReturnSingle = false) {
        $link = mysql_connect('localhost', 'root', 'learnlearn');
        mysql_select_db('andregagnon');
        mysql_set_charset('utf8');
        $sql = sprintf("SELECT * FROM wp_ahq_forum_topics %s;", $strExtra);

        $result =  mysql_query($sql);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Discussion();
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
        $this->intIdTopic = $arrData['t_id'];
        $this->arrData["title"] = $arrData['t_title'];//: "engineer rich networks",
        $this->arrData["author_email"] = 'agagnon@themewich.com';//"author_email": "towski@entp.com",
        $this->arrData["created_at"] = date('Y-m-dTh:i:s', $arrData['t_date']);// "2008-01-01T00:01:00Z",
        //$this->arrData["comments"] = array();
    }
    public function PopulateComments(){
        $this->arrComments = Comment::Query(
            'WHERE p_topic_id = ' .$this->intIdTopic . ''
        );
    }
    public function GetData(){
        $arrJson = $this->arrData;
        $arrJson["comments"] = array();
        foreach($this->arrComments as $objComment){
            $arrJson['comments'][] = $objComment->GetData();
        }
        return $arrJson;
    }
    /*
     *  File Name Example: categories/1/12.json
     *
     *
     {
    "title": "engineer rich networks",
    "author_email": "towski@entp.com",
    "created_at": "2008-01-01T00:01:00Z",
    "comments": [
            {
                "body": "Beatae suscipit sit",
                "author_email": "towski@entp.com",
                "created_at": "2008-01-01T00:01:00Z"
            },
            {
                "body": "Beatae suscipit sit",
                "author_email": "towski@entp.com",
                "created_at": "2008-01-01T00:01:00Z"
            }
        ]
    }
     */




}