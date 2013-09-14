<?php

class Comment{
    public $arrData = array();
    public static function Query($strExtra, $blnReturnSingle = false) {
        $link = mysql_connect('localhost', 'root', 'learnlearn');
        mysql_select_db('andregagnon');
        mysql_set_charset('utf8');
        $sql = sprintf(
            "SELECT wp_ahq_forum_posts.*, %s  FROM wp_ahq_forum_posts JOIN wp_users ON wp_ahq_forum_posts.p_author_id = wp_users.ID %s;",
            User::SELECT_EXT,
            $strExtra
        );

        $result =  mysql_query($sql);
        $arrReturn = array();
        while ($data = mysql_fetch_assoc($result)) {
            $tObj = new Comment();
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

        $this->arrData["body"] = $arrData['p_message'];//: "engineer rich networks",
        switch($arrData['email']){
            case('andre@designcirc.us'):
                $this->arrData['user_id'] = '2658066';
            break;
            case('eric@epschmidt.com'):
                $this->arrData['user_id'] = '2662471';
            break;
        }
        $this->arrData["author_email"] = $arrData['email'];//"author_email": "towski@entp.com",
        $this->arrData["created_at"] = date('Y-m-dTh:i:s', $arrData['p_date']);// "2008-01-01T00:01:00Z",
        User::ParseUser($arrData);
    }
    public function GetData(){
        return $this->arrData;
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