<?php
namespace todo\components;

use todo\model\Task;

class Helper
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function notPastDate($date)
    {
        $dateTime = strtotime($date);
        if ($dateTime > strtotime( 'now' )) {
            return true;
        } else {
            return false;
        }
    }


    public function allSubtasksDone($id)
    {
        if ($this->taskModel->checkSubTasksStatus($id)) {
            $data['id'] = $id;
            $data['status'] = 1;
            $this->taskModel->updateTask($data);
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
