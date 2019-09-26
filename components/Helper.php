<?php
namespace todo\components;

class Helper
{
    public function notPastDate($date)
    {
        $dateTime = strtotime($date);
        if ($dateTime > strtotime( 'now' )) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostData()
    {
        $postData = array();
        foreach ($_POST as $key => $value) {
            $postData[$key] = $value;
        }

        return $postData;
    }
}
