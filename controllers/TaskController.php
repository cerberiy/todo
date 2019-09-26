<?php

namespace todo\controllers;

use todo\model\Task;
use todo\components\Helper;

class TaskController
{

    private $taskModel;

    private $helper;

    public function __construct()
    {
        $this->taskModel = new Task();
        $this->helper = new Helper();
    }

    public function actionView()
    {
        $tasks = $this->taskModel->getTasks();
    }

    public function actionDelete()
    {
        $taskId = $_POST['id'];
        $response = $this->taskModel->deleteTask($taskId);

        return json_encode($response);
    }

    public function actionDeletesub()
    {
        $taskId = $_POST['id'];
        $response = $this->taskModel->deleteTasksub($taskId);

        return json_encode($response);
    }

    public function actionAdd()
    {
        $postData = $this->helper->getPostData();

        return json_encode($this->taskModel->addTask($postData));
    }

    public function actionAddsub()
    {
        $postData = $this->helper->getPostData();

        $this->helper->allSubtasksDone($postData['parent']);

        return json_encode($this->taskModel->addSub($postData));
    }

    public function actionUpdate()
    {
        $postData = $this->helper->getPostData();

        return json_encode($this->taskModel->updateTask($postData));
    }

    public function actionUpdatesub()
    {
        $postData = $this->helper->getPostData();

        $result = $this->taskModel->updateSubTask($postData);

        $this->helper->allSubtasksDone($postData['parent']);

        return json_encode($result);
    }
}

